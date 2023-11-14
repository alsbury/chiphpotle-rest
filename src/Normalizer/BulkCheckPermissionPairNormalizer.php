<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\BulkCheckPermissionPair;
use Chiphpotle\Rest\Model\BulkCheckPermissionRequestItem;
use Chiphpotle\Rest\Model\BulkCheckPermissionResponseItem;
use Chiphpotle\Rest\Model\RpcStatus;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class BulkCheckPermissionPairNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return $type === BulkCheckPermissionPair::class;
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return is_object($data) && $data::class === BulkCheckPermissionPair::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): BulkCheckPermissionPair
    {
        $object = new BulkCheckPermissionPair();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('request', $data)) {
            $object->setRequest($this->denormalizer->denormalize($data['request'], BulkCheckPermissionRequestItem::class, 'json', $context));
        }
        if (\array_key_exists('item', $data)) {
            $object->setItem($this->denormalizer->denormalize($data['item'], BulkCheckPermissionResponseItem::class, 'json', $context));
        }
        if (\array_key_exists('error', $data)) {
            $object->setError($this->denormalizer->denormalize($data['error'], RpcStatus::class, 'json', $context));
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
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
        return [BulkCheckPermissionPair::class => false];
    }
}
