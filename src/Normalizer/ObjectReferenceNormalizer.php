<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\ObjectReference;
use Chiphpotle\Rest\Runtime\Normalizer\ValidationException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

use function array_key_exists;

final class ObjectReferenceNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return $type === ObjectReference::class;
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return is_object($data) && $data::class === ObjectReference::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): ObjectReference
    {

        if (empty($data['objectType'])) {
            throw new ValidationException('Missing required objectType');
        }

        $object = new ObjectReference($data['objectType']);

        if (array_key_exists('objectId', $data)) {
            $object->setObjectId($data['objectId']);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getObjectType()) {
            $data['objectType'] = $object->getObjectType();
        }
        if (null !== $object->getObjectId()) {
            $data['objectId'] = $object->getObjectId();
        }
        return $data;
    }
}
