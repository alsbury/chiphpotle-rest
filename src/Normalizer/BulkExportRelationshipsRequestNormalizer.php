<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\BulkExportRelationshipsRequest;
use Chiphpotle\Rest\Model\Consistency;
use Chiphpotle\Rest\Model\Cursor;
use Jane\Component\JsonSchemaRuntime\Reference;
use Chiphpotle\Rest\Runtime\Normalizer\CheckArray;
use Chiphpotle\Rest\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class BulkExportRelationshipsRequestNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return $type === BulkExportRelationshipsRequest::class;
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === BulkExportRelationshipsRequest::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): BulkExportRelationshipsRequest|Reference
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new BulkExportRelationshipsRequest();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('consistency', $data)) {
            $object->setConsistency($this->denormalizer->denormalize($data['consistency'], Consistency::class, 'json', $context));
        }
        if (\array_key_exists('optionalLimit', $data)) {
            $object->setOptionalLimit($data['optionalLimit']);
        }
        if (\array_key_exists('optionalCursor', $data)) {
            $object->setOptionalCursor($this->denormalizer->denormalize($data['optionalCursor'], Cursor::class, 'json', $context));
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getConsistency()) {
            $data['consistency'] = $this->normalizer->normalize($object->getConsistency(), 'json', $context);
        }
        if (null !== $object->getOptionalLimit()) {
            $data['optionalLimit'] = $object->getOptionalLimit();
        }
        if (null !== $object->getOptionalCursor()) {
            $data['optionalCursor'] = $this->normalizer->normalize($object->getOptionalCursor(), 'json', $context);
        }
        return $data;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [BulkExportRelationshipsRequest::class => false];
    }
}
