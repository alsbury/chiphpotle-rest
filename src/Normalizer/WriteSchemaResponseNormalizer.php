<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\WriteSchemaResponse;
use Chiphpotle\Rest\Model\ZedToken;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class WriteSchemaResponseNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === WriteSchemaResponse::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && $data::class === WriteSchemaResponse::class;
    }

    public function denormalize($data, string $type, $format = null, array $context = []): WriteSchemaResponse
    {
        $object = new WriteSchemaResponse();
        if (\array_key_exists('writtenAt', $data)) {
            $object->setWrittenAt($this->denormalizer->denormalize($data['writtenAt'], ZedToken::class, 'json', $context));
        }
        return $object;
    }

    public function normalize(mixed $object, ?string $format = null, array $context = []): array
    {
        $data = [];
        if ($object->isInitialized('writtenAt') && null !== $object->getWrittenAt()) {
            $data['writtenAt'] = $this->normalizer->normalize($object->getWrittenAt(), 'json', $context);
        }
        return $data;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [WriteSchemaResponse::class => true];
    }
}
