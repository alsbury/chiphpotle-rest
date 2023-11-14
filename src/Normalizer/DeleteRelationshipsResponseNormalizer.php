<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\DeleteRelationshipsResponse;
use Chiphpotle\Rest\Model\ZedToken;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

use function array_key_exists;
use function is_array;

final class DeleteRelationshipsResponseNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === DeleteRelationshipsResponse::class;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return is_object($data) && $data::class === DeleteRelationshipsResponse::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): DeleteRelationshipsResponse
    {
        $object = new DeleteRelationshipsResponse();
        if (null === $data || false === is_array($data)) {
            return $object;
        }
        if (array_key_exists('deletedAt', $data)) {
            $object->setDeletedAt($this->denormalizer->denormalize($data['deletedAt'], ZedToken::class, 'json', $context));
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getDeletedAt()) {
            $data['deletedAt'] = $this->normalizer->normalize($object->getDeletedAt(), 'json', $context);
        }
        return $data;
    }
}
