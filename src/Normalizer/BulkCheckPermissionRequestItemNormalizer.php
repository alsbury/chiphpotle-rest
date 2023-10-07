<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\BulkCheckPermissionRequestItem;
use Jane\Component\JsonSchemaRuntime\Reference;
use Chiphpotle\Rest\Runtime\Normalizer\CheckArray;
use Chiphpotle\Rest\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class BulkCheckPermissionRequestItemNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return $type === 'Chiphpotle\\Rest\\Model\\BulkCheckPermissionRequestItem';
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === 'Chiphpotle\\Rest\\Model\\BulkCheckPermissionRequestItem';
    }

    public function denormalize($data, $class, $format = null, array $context = []): mixed
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new BulkCheckPermissionRequestItem();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('resource', $data)) {
            $object->setResource($this->denormalizer->denormalize($data['resource'], 'Chiphpotle\\Rest\\Model\\V1ObjectReference', 'json', $context));
        }
        if (\array_key_exists('permission', $data)) {
            $object->setPermission($data['permission']);
        }
        if (\array_key_exists('subject', $data)) {
            $object->setSubject($this->denormalizer->denormalize($data['subject'], 'Chiphpotle\\Rest\\Model\\V1SubjectReference', 'json', $context));
        }
        if (\array_key_exists('context', $data)) {
            $object->setContext($data['context']);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getResource()) {
            $data['resource'] = $this->normalizer->normalize($object->getResource(), 'json', $context);
        }
        if (null !== $object->getPermission()) {
            $data['permission'] = $object->getPermission();
        }
        if (null !== $object->getSubject()) {
            $data['subject'] = $this->normalizer->normalize($object->getSubject(), 'json', $context);
        }
        if (null !== $object->getContext()) {
            $data['context'] = $object->getContext();
        }
        return $data;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return ['Chiphpotle\\Rest\\Model\\BulkCheckPermissionRequestItem' => false];
    }
}
