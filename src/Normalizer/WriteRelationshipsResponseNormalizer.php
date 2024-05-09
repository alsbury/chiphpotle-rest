<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\WriteRelationshipsResponse;
use Chiphpotle\Rest\Model\ZedToken;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

use function array_key_exists;
use function is_array;

final class WriteRelationshipsResponseNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === WriteRelationshipsResponse::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && $data::class === WriteRelationshipsResponse::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): WriteRelationshipsResponse
    {
        $object = new WriteRelationshipsResponse();
        if (null === $data || false === is_array($data)) {
            return $object;
        }
        if (array_key_exists('writtenAt', $data)) {
            $object->setWrittenAt($this->denormalizer->denormalize($data['writtenAt'], ZedToken::class, 'json', $context));
        }
        return $object;
    }

    public function normalize(mixed $object, ?string $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getWrittenAt()) {
            $data['writtenAt'] = $this->normalizer->normalize($object->getWrittenAt(), 'json', $context);
        }
        return $data;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [WriteRelationshipsResponse::class => true];
    }
}
