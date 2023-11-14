<?php

namespace Chiphpotle\Rest\Normalizer;

use ArrayObject;
use Chiphpotle\Rest\Model\ProtobufAny;
use Chiphpotle\Rest\Model\RpcStatus;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

use function array_key_exists;
use function is_array;

final class RpcStatusNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === RpcStatus::class;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return is_object($data) && $data::class === RpcStatus::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): RpcStatus
    {
        $object = new RpcStatus();
        if (null === $data || false === is_array($data)) {
            return $object;
        }
        if (array_key_exists('code', $data)) {
            $object->setCode($data['code']);
        }
        if (array_key_exists('message', $data)) {
            $object->setMessage($data['message']);
        }
        if (array_key_exists('details', $data)) {
            $values = [];
            foreach ($data['details'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, ProtobufAny::class, 'json', $context);
            }
            $object->setDetails($values);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): float|int|bool|ArrayObject|array|string|null
    {
        $data = [];
        if (null !== $object->getCode()) {
            $data['code'] = $object->getCode();
        }
        if (null !== $object->getMessage()) {
            $data['message'] = $object->getMessage();
        }
        if (null !== $object->getDetails()) {
            $values = [];
            foreach ($object->getDetails() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data['details'] = $values;
        }
        return $data;
    }
}
