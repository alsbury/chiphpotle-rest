<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Enum\Permissionship;
use Chiphpotle\Rest\Model\BulkCheckPermissionResponseItem;
use Chiphpotle\Rest\Model\PartialCaveatInfo;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class BulkCheckPermissionResponseItemNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return $type === BulkCheckPermissionResponseItem::class;
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return is_object($data) && $data::class === BulkCheckPermissionResponseItem::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): BulkCheckPermissionResponseItem
    {
        $object = new BulkCheckPermissionResponseItem();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('permissionship', $data)) {
            $object->setPermissionship(Permissionship::from($data['permissionship']));
        }
        if (\array_key_exists('partialCaveatInfo', $data)) {
            $object->setPartialCaveatInfo($this->denormalizer->denormalize($data['partialCaveatInfo'], PartialCaveatInfo::class, 'json', $context));
        }
        return $object;
    }

    /**
     * @param BulkCheckPermissionResponseItem $object
     */
    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getPermissionship()) {
            $data['permissionship'] = $object->getPermissionship()->value;
        }
        if (null !== $object->getPartialCaveatInfo()) {
            $data['partialCaveatInfo'] = $this->normalizer->normalize($object->getPartialCaveatInfo(), 'json', $context);
        }
        return $data;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [BulkCheckPermissionResponseItem::class => false];
    }
}
