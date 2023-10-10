<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\Relationship;
use Chiphpotle\Rest\Model\RelationshipUpdate;
use Jane\Component\JsonSchemaRuntime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

use function array_key_exists;
use function is_array;

final class RelationshipUpdateNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === RelationshipUpdate::class;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return is_object($data) && get_class($data) === RelationshipUpdate::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): RelationshipUpdate|Reference
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new RelationshipUpdate();
        if (null === $data || false === is_array($data)) {
            return $object;
        }
        if (array_key_exists('operation', $data)) {
            $object->setOperation($data['operation']);
        }
        if (array_key_exists('relationship', $data)) {
            $object->setRelationship($this->denormalizer->denormalize($data['relationship'], Relationship::class, 'json', $context));
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getOperation()) {
            $data['operation'] = $object->getOperation();
        }
        if (null !== $object->getRelationship()) {
            $data['relationship'] = $this->normalizer->normalize($object->getRelationship(), 'json', $context);
        }
        return $data;
    }
}
