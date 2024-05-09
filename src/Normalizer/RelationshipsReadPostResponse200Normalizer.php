<?php

namespace Chiphpotle\Rest\Normalizer;

use ArrayObject;
use Chiphpotle\Rest\Model\ReadRelationshipsResponse;
use Chiphpotle\Rest\Model\RelationshipsReadPostResponse200;
use Chiphpotle\Rest\Model\RpcStatus;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

use function array_key_exists;
use function is_array;

final class RelationshipsReadPostResponse200Normalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return $type === RelationshipsReadPostResponse200::class;
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return is_object($data) && $data::class === RelationshipsReadPostResponse200::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): RelationshipsReadPostResponse200
    {
        $object = new RelationshipsReadPostResponse200();
        if (null === $data || false === is_array($data)) {
            return $object;
        }

        if (array_key_exists('error', $data)) {
            $object->setError($this->denormalizer->denormalize($data['error'], RpcStatus::class, 'json', $context));
        }
        if ($data !== []) {
            $result = [];
            foreach ($data as $part) {
                $result[] = $this->denormalizer->denormalize($part['result'], ReadRelationshipsResponse::class, 'json', $context);
            }
            $object->setResult($result);
        }
        return $object;
    }

    public function normalize($object, string $format = null, array $context = []): float|int|bool|ArrayObject|array|string|null
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

    public function getSupportedTypes(?string $format): array
    {
        return [RelationshipsReadPostResponse200::class => true];
    }
}
