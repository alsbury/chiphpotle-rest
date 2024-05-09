<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\BulkExportRelationshipsResponse;
use Chiphpotle\Rest\Model\Cursor;
use Chiphpotle\Rest\Model\Relationship;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class BulkExportRelationshipsResponseNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === BulkExportRelationshipsResponse::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && $data::class === BulkExportRelationshipsResponse::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): BulkExportRelationshipsResponse
    {
        $object = new BulkExportRelationshipsResponse();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('afterResultCursor', $data)) {
            $object->setAfterResultCursor($this->denormalizer->denormalize($data['afterResultCursor'], Cursor::class, 'json', $context));
        }
        if (\array_key_exists('relationships', $data)) {
            $values = [];
            foreach ($data['relationships'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, Relationship::class, 'json', $context);
            }
            $object->setRelationships($values);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getAfterResultCursor()) {
            $data['afterResultCursor'] = $this->normalizer->normalize($object->getAfterResultCursor(), 'json', $context);
        }
        if (null !== $object->getRelationships()) {
            $values = [];
            foreach ($object->getRelationships() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data['relationships'] = $values;
        }
        return $data;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [BulkExportRelationshipsResponse::class => true];
    }
}
