<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\ObjectReference;
use Jane\Component\JsonSchemaRuntime\Reference;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
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

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === ObjectReference::class;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return is_object($data) && get_class($data) === ObjectReference::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): ObjectReference|Reference
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }

        if (empty($data['objectType'])) {
            throw new InvalidArgumentException('Missing required objectType');
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
