<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\AlgebraicSubjectSet;
use Chiphpotle\Rest\Model\DirectSubjectSet;
use Chiphpotle\Rest\Model\ObjectReference;
use Chiphpotle\Rest\Model\PermissionRelationshipTree;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

use function array_key_exists;
use function is_array;

final class PermissionRelationshipTreeNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === PermissionRelationshipTree::class;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return is_object($data) && $data::class === PermissionRelationshipTree::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): PermissionRelationshipTree
    {
        $object = new PermissionRelationshipTree();
        if (null === $data || false === is_array($data)) {
            return $object;
        }
        if (array_key_exists('intermediate', $data)) {
            $object->setIntermediate($this->denormalizer->denormalize($data['intermediate'], AlgebraicSubjectSet::class, 'json', $context));
        }
        if (array_key_exists('leaf', $data)) {
            $object->setLeaf($this->denormalizer->denormalize($data['leaf'], DirectSubjectSet::class, 'json', $context));
        }
        if (array_key_exists('expandedObject', $data)) {
            $object->setExpandedObject($this->denormalizer->denormalize($data['expandedObject'], ObjectReference::class, 'json', $context));
        }
        if (array_key_exists('expandedRelation', $data)) {
            $object->setExpandedRelation($data['expandedRelation']);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
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
