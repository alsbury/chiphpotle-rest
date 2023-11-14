<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\BulkImportRelationshipsResponse;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class BulkImportRelationshipsResponseNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return $type === BulkImportRelationshipsResponse::class;
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return is_object($data) && $data::class === BulkImportRelationshipsResponse::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): BulkImportRelationshipsResponse
    {
        $object = new BulkImportRelationshipsResponse();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('numLoaded', $data)) {
            $object->setNumLoaded($data['numLoaded']);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getNumLoaded()) {
            $data['numLoaded'] = $object->getNumLoaded();
        }
        return $data;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [BulkImportRelationshipsResponse::class => false];
    }
}
