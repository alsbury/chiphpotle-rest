<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\LookupResourcesResponse;
use Chiphpotle\Rest\Model\PermissionsResourcesPostResponse200;
use Chiphpotle\Rest\Model\RpcStatus;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

use function array_key_exists;
use function is_array;

final class PermissionsResourcesPostResponse200Normalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === PermissionsResourcesPostResponse200::class;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return is_object($data) && get_class($data) === PermissionsResourcesPostResponse200::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): PermissionsResourcesPostResponse200
    {
        $object = new PermissionsResourcesPostResponse200();
        if (null === $data || false === is_array($data)) {
            return $object;
        }
        if (array_key_exists('result', $data)) {
            $object->setResult($this->denormalizer->denormalize($data['result'], LookupResourcesResponse::class, 'json', $context));
        }
        if (array_key_exists('error', $data)) {
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
}
