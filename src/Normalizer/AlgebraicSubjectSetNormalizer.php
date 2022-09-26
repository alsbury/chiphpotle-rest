<?php

namespace Chiphpotle\Rest\Normalizer;

use ArrayObject;
use Chiphpotle\Rest\Model\AlgebraicSubjectSet;
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

class AlgebraicSubjectSetNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === 'Chiphpotle\\Rest\\Model\\AlgebraicSubjectSet';
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return is_object($data) && get_class($data) === 'Chiphpotle\\Rest\\Model\\AlgebraicSubjectSet';
    }

    public function denormalize($data, $class, $format = null, array $context = []): mixed
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new AlgebraicSubjectSet();
        if (null === $data || false === is_array($data)) {
            return $object;
        }
        if (array_key_exists('operation', $data)) {
            $object->setOperation($data['operation']);
        }
        if (array_key_exists('children', $data)) {
            $values = [];
            foreach ($data['children'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, 'Chiphpotle\\Rest\\Model\\PermissionRelationshipTree', 'json', $context);
            }
            $object->setChildren($values);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): float|int|bool|ArrayObject|array|string|null
    {
        $data = [];
        if (null !== $object->getOperation()) {
            $data['operation'] = $object->getOperation();
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