<?php

namespace Chiphpotle\Rest\Normalizer;

use ArrayObject;
use Chiphpotle\Rest\Enum\PreconditionOperation;
use Chiphpotle\Rest\Model\Precondition;
use Chiphpotle\Rest\Model\RelationshipFilter;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

use function array_key_exists;
use function is_array;

final class PreconditionNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return $type === Precondition::class;
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return is_object($data) && $data::class === Precondition::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): Precondition
    {
        $object = new Precondition();
        if (null === $data || false === is_array($data)) {
            return $object;
        }
        if (array_key_exists('operation', $data)) {
            $object->setOperation(PreconditionOperation::from($data['operation']));
        }
        if (array_key_exists('filter', $data)) {
            $object->setFilter($this->denormalizer->denormalize($data['filter'], RelationshipFilter::class, 'json', $context));
        }
        return $object;
    }

    /**
     * @param Precondition $object
     */
    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getOperation()) {
            $data['operation'] = $object->getOperation()->value;
        }
        if (null !== $object->getFilter()) {
            $data['filter'] = $this->normalizer->normalize($object->getFilter(), 'json', $context);
        }
        return $data;
    }
}
