<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\BulkCheckPermissionPair;
use Chiphpotle\Rest\Model\BulkCheckPermissionResponse;
use Chiphpotle\Rest\Model\ZedToken;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class BulkCheckPermissionResponseNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === BulkCheckPermissionResponse::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && $data::class === BulkCheckPermissionResponse::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): BulkCheckPermissionResponse
    {
        $object = new BulkCheckPermissionResponse();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('checkedAt', $data)) {
            $object->setCheckedAt($this->denormalizer->denormalize($data['checkedAt'], ZedToken::class, 'json', $context));
        }
        if (\array_key_exists('pairs', $data)) {
            $values = [];
            foreach ($data['pairs'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, BulkCheckPermissionPair::class, 'json', $context);
            }
            $object->setPairs($values);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getCheckedAt()) {
            $data['checkedAt'] = $this->normalizer->normalize($object->getCheckedAt(), 'json', $context);
        }
        if (null !== $object->getPairs()) {
            $values = [];
            foreach ($object->getPairs() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data['pairs'] = $values;
        }
        return $data;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [BulkCheckPermissionResponse::class => true];
    }
}
