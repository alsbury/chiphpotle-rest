<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\ReadRelationshipsResponse;
use Chiphpotle\Rest\Model\Relationship;
use Chiphpotle\Rest\Model\ZedToken;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

use function array_key_exists;
use function is_array;

final class ReadRelationshipsResponseNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === ReadRelationshipsResponse::class;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return is_object($data) && $data::class === ReadRelationshipsResponse::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): ReadRelationshipsResponse
    {
        $object = new ReadRelationshipsResponse();
        if (null === $data || false === is_array($data)) {
            return $object;
        }
        if (array_key_exists('readAt', $data)) {
            $object->setReadAt($this->denormalizer->denormalize($data['readAt'], ZedToken::class, 'json', $context));
        }
        if (array_key_exists('relationship', $data)) {
            $object->setRelationship($this->denormalizer->denormalize($data['relationship'], Relationship::class, 'json', $context));
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getReadAt()) {
            $data['readAt'] = $this->normalizer->normalize($object->getReadAt(), 'json', $context);
        }
        if (null !== $object->getRelationship()) {
            $data['relationship'] = $this->normalizer->normalize($object->getRelationship(), 'json', $context);
        }
        return $data;
    }
}
