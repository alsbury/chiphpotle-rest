<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\RelationshipUpdate;
use Chiphpotle\Rest\Model\WatchResponse;
use Chiphpotle\Rest\Model\ZedToken;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class WatchResponseNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === WatchResponse::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && $data::class === WatchResponse::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): WatchResponse
    {
        $object = new WatchResponse();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('updates', $data)) {
            $values = [];
            foreach ($data['updates'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, RelationshipUpdate::class, 'json', $context);
            }
            $object->setUpdates($values);
        }
        if (\array_key_exists('changesThrough', $data)) {
            $object->setChangesThrough($this->denormalizer->denormalize($data['changesThrough'], ZedToken::class, 'json', $context));
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getUpdates()) {
            $values = [];
            foreach ($object->getUpdates() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data['updates'] = $values;
        }
        if (null !== $object->getChangesThrough()) {
            $data['changesThrough'] = $this->normalizer->normalize($object->getChangesThrough(), 'json', $context);
        }
        return $data;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [WatchResponse::class => true];
    }
}
