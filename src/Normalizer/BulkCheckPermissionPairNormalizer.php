<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\BulkCheckPermissionPair;
use Jane\Component\JsonSchemaRuntime\Reference;
use Chiphpotle\Rest\Runtime\Normalizer\CheckArray;
use Chiphpotle\Rest\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class BulkCheckPermissionPairNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return $type === 'Chiphpotle\\Rest\\Model\\BulkCheckPermissionPair';
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === 'Chiphpotle\\Rest\\Model\\BulkCheckPermissionPair';
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): BulkCheckPermissionPair|Reference
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new BulkCheckPermissionPair();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('request', $data)) {
            $object->setRequest($this->denormalizer->denormalize($data['request'], 'Chiphpotle\\Rest\\Model\\BulkCheckPermissionRequestItem', 'json', $context));
        }
        if (\array_key_exists('item', $data)) {
            $object->setItem($this->denormalizer->denormalize($data['item'], 'Chiphpotle\\Rest\\Model\\BulkCheckPermissionResponseItem', 'json', $context));
        }
        if (\array_key_exists('error', $data)) {
            $object->setError($this->denormalizer->denormalize($data['error'], 'Chiphpotle\\Rest\\Model\\RpcStatus', 'json', $context));
        }
        return $object;
    }

    /**
     * @return array|string|int|float|bool|\ArrayObject|null
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $data = [];
        if (null !== $object->getRequest()) {
            $data['request'] = $this->normalizer->normalize($object->getRequest(), 'json', $context);
        }
        if (null !== $object->getItem()) {
            $data['item'] = $this->normalizer->normalize($object->getItem(), 'json', $context);
        }
        if (null !== $object->getError()) {
            $data['error'] = $this->normalizer->normalize($object->getError(), 'json', $context);
        }
        return $data;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return ['Chiphpotle\\Rest\\Model\\BulkCheckPermissionPair' => false];
    }
}
