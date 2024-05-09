<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\BulkCheckPermissionRequest;
use Chiphpotle\Rest\Model\BulkCheckPermissionRequestItem;
use Chiphpotle\Rest\Model\Consistency;
use Chiphpotle\Rest\Runtime\Normalizer\RequiredDataValidator;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class BulkCheckPermissionRequestNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use RequiredDataValidator;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === BulkCheckPermissionRequest::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && $data::class === BulkCheckPermissionRequest::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): BulkCheckPermissionRequest
    {
        $this->checkRequired($data, ['items']);
        $items = [];
        foreach ($data['items'] as $value) {
            $items[] = $this->denormalizer->denormalize($value, BulkCheckPermissionRequestItem::class, 'json', $context);
        }

        $object = new BulkCheckPermissionRequest($items);

        if (\array_key_exists('consistency', $data)) {
            $object->setConsistency($this->denormalizer->denormalize($data['consistency'], Consistency::class, 'json', $context));
        }

        return $object;
    }

    public function normalize(mixed $object, ?string $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getConsistency()) {
            $data['consistency'] = $this->normalizer->normalize($object->getConsistency(), 'json', $context);
        }
        if (null !== $object->getItems()) {
            $values = [];
            foreach ($object->getItems() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data['items'] = $values;
        }
        return $data;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [BulkCheckPermissionRequest::class => true];
    }
}
