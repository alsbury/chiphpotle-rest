<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Enum\Permissionship;
use Chiphpotle\Rest\Model\CheckPermissionResponse;
use Chiphpotle\Rest\Model\ZedToken;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

use function array_key_exists;
use function is_array;

final class CheckPermissionResponseNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === CheckPermissionResponse::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && $data::class === CheckPermissionResponse::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): CheckPermissionResponse
    {
        $object = new CheckPermissionResponse();
        if (null === $data || false === is_array($data)) {
            return $object;
        }
        if (array_key_exists('checkedAt', $data)) {
            $object->setCheckedAt($this->denormalizer->denormalize($data['checkedAt'], ZedToken::class, 'json', $context));
        }
        if (array_key_exists('permissionship', $data)) {
            $object->setPermissionship(Permissionship::from($data['permissionship']));
        }
        return $object;
    }

    /**
     * @param CheckPermissionResponse $object
     */
    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getCheckedAt()) {
            $data['checkedAt'] = $this->normalizer->normalize($object->getCheckedAt(), 'json', $context);
        }
        if (null !== $object->getPermissionship()) {
            $data['permissionship'] = $object->getPermissionship()->value;
        }
        if (null !== $object->getPartialCaveatInfo()) {
            $data['partialCaveatInfo'] = $this->normalizer->normalize($object->getPartialCaveatInfo(), 'json', $context);
        }
        return $data;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [CheckPermissionResponse::class => true];
    }
}
