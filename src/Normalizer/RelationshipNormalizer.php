<?php

namespace Chiphpotle\Rest\Normalizer;

use ArrayObject;
use Chiphpotle\Rest\Model\Relationship;
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

class RelationshipNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === 'Chiphpotle\\Rest\\Model\\Relationship';
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return is_object($data) && get_class($data) === 'Chiphpotle\\Rest\\Model\\Relationship';
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): Relationship|Reference
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new Relationship();
        if (null === $data || false === is_array($data)) {
            return $object;
        }
        if (array_key_exists('resource', $data)) {
            $object->setResource($this->denormalizer->denormalize($data['resource'], 'Chiphpotle\\Rest\\Model\\ObjectReference', 'json', $context));
        }
        if (array_key_exists('relation', $data)) {
            $object->setRelation($data['relation']);
        }
        if (array_key_exists('subject', $data)) {
            $object->setSubject($this->denormalizer->denormalize($data['subject'], 'Chiphpotle\\Rest\\Model\\SubjectReference', 'json', $context));
        }
        return $object;
    }

    public function normalize(mixed $object, string $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getResource()) {
            $data['resource'] = $this->normalizer->normalize($object->getResource(), 'json', $context);
        }
        if (null !== $object->getRelation()) {
            $data['relation'] = $object->getRelation();
        }
        if (null !== $object->getSubject()) {
            $data['subject'] = $this->normalizer->normalize($object->getSubject(), 'json', $context);
        }
        if (null !== $object->getOptionalCaveat()) {
            $data['optionalCaveat'] = $this->normalizer->normalize($object->getOptionalCaveat(), 'json', $context);
        }
        return $data;
    }
}
