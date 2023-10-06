<?php

namespace Chiphpotle\Rest\Normalizer;

use ArrayObject;
use Chiphpotle\Rest\Model\PermissionRelationshipTree;
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

class PermissionRelationshipTreeNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === 'Chiphpotle\\Rest\\Model\\PermissionRelationshipTree';
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return is_object($data) && get_class($data) === 'Chiphpotle\\Rest\\Model\\PermissionRelationshipTree';
    }

    public function denormalize($data, $class, $format = null, array $context = []): mixed
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new PermissionRelationshipTree();
        if (null === $data || false === is_array($data)) {
            return $object;
        }
        if (array_key_exists('intermediate', $data)) {
            $object->setIntermediate($this->denormalizer->denormalize($data['intermediate'], 'Chiphpotle\\Rest\\Model\\AlgebraicSubjectSet', 'json', $context));
        }
        if (array_key_exists('leaf', $data)) {
            $object->setLeaf($this->denormalizer->denormalize($data['leaf'], 'Chiphpotle\\Rest\\Model\\DirectSubjectSet', 'json', $context));
        }
        if (array_key_exists('expandedObject', $data)) {
            $object->setExpandedObject($this->denormalizer->denormalize($data['expandedObject'], 'Chiphpotle\\Rest\\Model\\ObjectReference', 'json', $context));
        }
        if (array_key_exists('expandedRelation', $data)) {
            $object->setExpandedRelation($data['expandedRelation']);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): float|int|bool|ArrayObject|array|string|null
    {
        $data = [];
        if (null !== $object->getIntermediate()) {
            $data['intermediate'] = $this->normalizer->normalize($object->getIntermediate(), 'json', $context);
        }
        if (null !== $object->getLeaf()) {
            $data['leaf'] = $this->normalizer->normalize($object->getLeaf(), 'json', $context);
        }
        if (null !== $object->getExpandedObject()) {
            $data['expandedObject'] = $this->normalizer->normalize($object->getExpandedObject(), 'json', $context);
        }
        if (null !== $object->getExpandedRelation()) {
            $data['expandedRelation'] = $object->getExpandedRelation();
        }
        return $data;
    }
}
