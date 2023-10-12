<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\LookupSubjectsResponse;
use Chiphpotle\Rest\Model\PermissionsSubjectsPostResponse200;
use ArrayObject;
use Chiphpotle\Rest\Model\RpcStatus;
use Chiphpotle\Rest\Runtime\Client\RpcException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

use function array_key_exists;
use function is_array;

final class PermissionsSubjectsPostResponse200Normalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === PermissionsSubjectsPostResponse200::class;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return is_object($data) && get_class($data) === PermissionsSubjectsPostResponse200::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): PermissionsSubjectsPostResponse200
    {
        $object = new PermissionsSubjectsPostResponse200();

        $results = [];
        foreach ($data as $resultData) {
            if (array_key_exists('result', $resultData)) {
                $results[] = $this->denormalizer->denormalize($resultData['result'], LookupSubjectsResponse::class, 'json', $context);
            } elseif (array_key_exists('error', $resultData)) {
                $rpcStatus = $this->denormalizer->denormalize($resultData['error'], RpcStatus::class, 'json', $context);
                throw new RpcException($rpcStatus);
            }
        }

        return $object->setResults($results);
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
