<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\CheckBulkPermissionsPair;
use Chiphpotle\Rest\Model\CheckBulkPermissionsResponse;
use Chiphpotle\Rest\Model\ZedToken;
use Jane\Component\JsonSchemaRuntime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class CheckBulkPermissionsResponseNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, string $format = null, array $context = []): bool
    {
        return $type === CheckBulkPermissionsResponse::class;
    }

    public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
    {
        return $data instanceof \Chiphpotle\Rest\Model\CheckBulkPermissionsResponse;
    }

    public function denormalize($data, $type, $format = null, array $context = []): CheckBulkPermissionsResponse
    {
        $object = new CheckBulkPermissionsResponse();
        if (\array_key_exists('checkedAt', $data)) {
            $object->setCheckedAt($this->denormalizer->denormalize($data['checkedAt'], ZedToken::class, 'json', $context));
        }
        if (\array_key_exists('pairs', $data)) {
            $values = [];
            foreach ($data['pairs'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, CheckBulkPermissionsPair::class, 'json', $context);
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
        return [CheckBulkPermissionsResponse::class => true];
    }
}
