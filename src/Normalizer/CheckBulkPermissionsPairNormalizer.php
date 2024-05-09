<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\CheckBulkPermissionsPair;
use Chiphpotle\Rest\Model\CheckBulkPermissionsRequestItem;
use Chiphpotle\Rest\Model\CheckBulkPermissionsResponseItem;
use Chiphpotle\Rest\Model\RpcStatus;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class CheckBulkPermissionsPairNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, string $format = null, array $context = []): bool
    {
        return $type === CheckBulkPermissionsPair::class;
    }

    public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
    {
        return $data instanceof \Chiphpotle\Rest\Model\CheckBulkPermissionsPair;
    }

    public function denormalize($data, $type, $format = null, array $context = []): CheckBulkPermissionsPair
    {
        $object = new CheckBulkPermissionsPair();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('request', $data)) {
            $object->setRequest($this->denormalizer->denormalize($data['request'], CheckBulkPermissionsRequestItem::class, 'json', $context));
        }
        if (\array_key_exists('item', $data)) {
            $object->setItem($this->denormalizer->denormalize($data['item'], CheckBulkPermissionsResponseItem::class, 'json', $context));
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
        return [CheckBulkPermissionsPair::class => true];
    }
}
