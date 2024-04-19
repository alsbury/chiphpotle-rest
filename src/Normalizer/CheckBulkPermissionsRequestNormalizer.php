<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\CheckBulkPermissionsRequest;
use Chiphpotle\Rest\Model\CheckBulkPermissionsRequestItem;
use Chiphpotle\Rest\Model\Consistency;
use Chiphpotle\Rest\Runtime\Normalizer\RequiredDataValidator;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class CheckBulkPermissionsRequestNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use RequiredDataValidator;

    public function supportsDenormalization($data, $type, string $format = null, array $context = []): bool
    {
        return $type === CheckBulkPermissionsRequest::class;
    }

    public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
    {
        return $data instanceof \Chiphpotle\Rest\Model\CheckBulkPermissionsRequest;
    }

    public function denormalize($data, $type, $format = null, array $context = []): CheckBulkPermissionsRequest
    {
        $this->checkRequired($data, ['items']);
        $items = [];
        foreach ($data['items'] as $value) {
            $items[] = $this->denormalizer->denormalize($value, CheckBulkPermissionsRequestItem::class, 'json', $context);
        }

        $object = new CheckBulkPermissionsRequest($items);

        if (\array_key_exists('consistency', $data)) {
            $object->setConsistency($this->denormalizer->denormalize($data['consistency'], Consistency::class, 'json', $context));
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
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
        return [CheckBulkPermissionsRequest::class => false];
    }
}
