<?php

namespace Chiphpotle\Rest\Normalizer;

use ArrayObject;
use Chiphpotle\Rest\Enum\AlgebraicOperation;
use Chiphpotle\Rest\Model\AlgebraicSubjectSet;
use Chiphpotle\Rest\Model\PermissionRelationshipTree;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

use function array_key_exists;
use function is_array;

final class AlgebraicSubjectSetNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return $type === AlgebraicSubjectSet::class;
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return is_object($data) && $data::class === AlgebraicSubjectSet::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): AlgebraicSubjectSet
    {
        $object = new AlgebraicSubjectSet();
        if (null === $data || false === is_array($data)) {
            return $object;
        }
        if (array_key_exists('operation', $data)) {
            $object->setOperation(AlgebraicOperation::from($data['operation']));
        }
        if (array_key_exists('children', $data)) {
            $values = [];
            foreach ($data['children'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, PermissionRelationshipTree::class, 'json', $context);
            }
            $object->setChildren($values);
        }
        return $object;
    }

    /**
     * @param AlgebraicSubjectSet $object
     */
    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getOperation()) {
            $data['operation'] = $object->getOperation()->value;
        }
        if (null !== $object->getChildren()) {
            $values = [];
            foreach ($object->getChildren() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data['children'] = $values;
        }
        return $data;
    }
}
