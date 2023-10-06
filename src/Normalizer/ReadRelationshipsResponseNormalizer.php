<?php

namespace Chiphpotle\Rest\Normalizer;

use ArrayObject;
use Chiphpotle\Rest\Model\ReadRelationshipsResponse;
use Chiphpotle\Rest\Runtime\Normalizer\CheckArray;
use Jane\Component\JsonSchemaRuntime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

use function array_key_exists;
use function is_array;

class ReadRelationshipsResponseNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === 'Chiphpotle\\Rest\\Model\\ReadRelationshipsResponse';
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return is_object($data) && get_class($data) === 'Chiphpotle\\Rest\\Model\\ReadRelationshipsResponse';
    }

    public function denormalize($data, $class, $format = null, array $context = []): mixed
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new ReadRelationshipsResponse();
        if (null === $data || false === is_array($data)) {
            return $object;
        }
        if (array_key_exists('readAt', $data)) {
            $object->setReadAt($this->denormalizer->denormalize($data['readAt'], 'Chiphpotle\\Rest\\Model\\ZedToken', 'json', $context));
        }
        if (array_key_exists('relationship', $data)) {
            $object->setRelationship($this->denormalizer->denormalize($data['relationship'], 'Chiphpotle\\Rest\\Model\\Relationship', 'json', $context));
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): float|int|bool|ArrayObject|array|string|null
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
