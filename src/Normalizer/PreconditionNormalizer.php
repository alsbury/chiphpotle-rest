<?php

namespace Chiphpotle\Rest\Normalizer;

use ArrayObject;
use Chiphpotle\Rest\Model\Precondition;
use Chiphpotle\Rest\Model\RelationshipFilter;
use Chiphpotle\Rest\Runtime\Normalizer\CheckArray;
use Jane\Component\JsonSchemaRuntime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

use function array_key_exists;
use function is_array;

class PreconditionNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === Precondition::class;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return is_object($data) && get_class($data) === Precondition::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): Precondition|Reference
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new Precondition();
        if (null === $data || false === is_array($data)) {
            return $object;
        }
        if (array_key_exists('operation', $data)) {
            $object->setOperation($data['operation']);
        }
        if (array_key_exists('filter', $data)) {
            $object->setFilter($this->denormalizer->denormalize($data['filter'], RelationshipFilter::class, 'json', $context));
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getOperation()) {
            $data['operation'] = $object->getOperation();
        }
        if (null !== $object->getFilter()) {
            $data['filter'] = $this->normalizer->normalize($object->getFilter(), 'json', $context);
        }
        return $data;
    }
}
