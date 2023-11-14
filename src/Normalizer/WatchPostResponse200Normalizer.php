<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\RpcStatus;
use Chiphpotle\Rest\Model\WatchPostResponse200;
use Chiphpotle\Rest\Model\WatchResponse;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class WatchPostResponse200Normalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return $type === WatchPostResponse200::class;
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return is_object($data) && $data::class === WatchPostResponse200::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): WatchPostResponse200
    {
        $object = new WatchPostResponse200();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('result', $data)) {
            $object->setResult($this->denormalizer->denormalize($data['result'], WatchResponse::class, 'json', $context));
        }
        if (\array_key_exists('error', $data)) {
            $object->setError($this->denormalizer->denormalize($data['error'], RpcStatus::class, 'json', $context));
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getResult()) {
            $data['result'] = $this->normalizer->normalize($object->getResult(), 'json', $context);
        }
        if (null !== $object->getError()) {
            $data['error'] = $this->normalizer->normalize($object->getError(), 'json', $context);
        }
        return $data;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [WatchPostResponse200::class => false];
    }
}
