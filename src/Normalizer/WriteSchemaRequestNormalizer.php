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

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === WriteSchemaRequest::class;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return is_object($data) && get_class($data) === WriteSchemaRequest::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): WriteSchemaRequest
    {
        if (empty($data['schema'])) {
            throw new ValidationException('Missing required schema');
        }

        return new WriteSchemaRequest($data['schema']);
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        $data['schema'] = $object->getSchema();
        return $data;
    }
}
