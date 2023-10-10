<?php

namespace Chiphpotle\Rest\Normalizer;

use ArrayObject;
use Chiphpotle\Rest\Model\ExpandPermissionTreeResponse;
use Chiphpotle\Rest\Model\PermissionRelationshipTree;
use Chiphpotle\Rest\Model\ZedToken;
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

final class ExpandPermissionTreeResponseNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === ExpandPermissionTreeResponse::class;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return is_object($data) && get_class($data) === ExpandPermissionTreeResponse::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): ExpandPermissionTreeResponse|Reference
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new ExpandPermissionTreeResponse();
        if (null === $data || false === is_array($data)) {
            return $object;
        }
        if (array_key_exists('expandedAt', $data)) {
            $object->setExpandedAt($this->denormalizer->denormalize($data['expandedAt'], ZedToken::class, 'json', $context));
        }
        if (array_key_exists('treeRoot', $data)) {
            $object->setTreeRoot($this->denormalizer->denormalize($data['treeRoot'], PermissionRelationshipTree::class, 'json', $context));
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): float|int|bool|ArrayObject|array|string|null
    {
        $data = [];
        if (null !== $object->getExpandedAt()) {
            $data['expandedAt'] = $this->normalizer->normalize($object->getExpandedAt(), 'json', $context);
        }
        if (null !== $object->getTreeRoot()) {
            $data['treeRoot'] = $this->normalizer->normalize($object->getTreeRoot(), 'json', $context);
        }
        return $data;
    }
}
