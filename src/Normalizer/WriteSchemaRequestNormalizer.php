<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\WriteSchemaRequest;
use Chiphpotle\Rest\Runtime\Normalizer\ValidationException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class WriteSchemaRequestNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === WriteSchemaRequest::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && $data::class === WriteSchemaRequest::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): WriteSchemaRequest
    {
        if (empty($data['schema'])) {
            throw new ValidationException('Missing required schema');
        }

        return new WriteSchemaRequest($data['schema']);
    }

    public function normalize(mixed $object, ?string $format = null, array $context = []): array
    {
        return ['schema' => $object->getSchema()];
    }

    public function getSupportedTypes(?string $format): array
    {
        return [WriteSchemaRequest::class => true];
    }
}
