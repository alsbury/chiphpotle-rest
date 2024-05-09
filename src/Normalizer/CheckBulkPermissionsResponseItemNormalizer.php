<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Enum\Permissionship;
use Chiphpotle\Rest\Model\CheckBulkPermissionsResponseItem;
use Chiphpotle\Rest\Model\PartialCaveatInfo;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class CheckBulkPermissionsResponseItemNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, string $format = null, array $context = []): bool
    {
        return $type === CheckBulkPermissionsResponseItem::class;
    }

    public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
    {
        return $data instanceof \Chiphpotle\Rest\Model\CheckBulkPermissionsResponseItem;
    }

    public function denormalize($data, $type, $format = null, array $context = []): CheckBulkPermissionsResponseItem
    {
        $object = new CheckBulkPermissionsResponseItem();

        if (\array_key_exists('permissionship', $data)) {
            $object->setPermissionship(Permissionship::from($data['permissionship']));
        }
        if (\array_key_exists('partialCaveatInfo', $data)) {
            $object->setPartialCaveatInfo($this->denormalizer->denormalize($data['partialCaveatInfo'], PartialCaveatInfo::class, 'json', $context));
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if ($object->isInitialized('permissionship') && null !== $object->getPermissionship()) {
            $data['permissionship'] = $object->getPermissionship();
        }
        if ($object->isInitialized('partialCaveatInfo') && null !== $object->getPartialCaveatInfo()) {
            $data['partialCaveatInfo'] = $this->normalizer->normalize($object->getPartialCaveatInfo(), 'json', $context);
        }
        return $data;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [CheckBulkPermissionsResponseItem::class => true];
    }
}
