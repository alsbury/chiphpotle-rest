<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\ContextualizedCaveat;
use Chiphpotle\Rest\Model\ObjectReference;
use Chiphpotle\Rest\Model\Relationship;
use Chiphpotle\Rest\Model\SubjectReference;
use Chiphpotle\Rest\Runtime\Normalizer\CheckArray;
use Jane\Component\JsonSchemaRuntime\Reference;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class RelationshipNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === Relationship::class;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return is_object($data) && get_class($data) === Relationship::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): Relationship|Reference
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }

        $missing = array_filter(['resource', 'relation', 'subject'], fn (string $field) => empty($data[$field]));
        if (!empty($missing)) {
            throw new InvalidArgumentException('Missing required '.implode(', ', $missing));
        }

        $resource = $this->denormalizer->denormalize($data['resource'], ObjectReference::class, 'json', $context);
        $relation = $data['relation'];
        $subject = $this->denormalizer->denormalize($data['subject'], SubjectReference::class, 'json', $context);

        $relationship =  new Relationship($resource, $relation, $subject);

        if (!empty($data['optionalCaveat'])) {
            $relationship->setOptionalCaveat($this->denormalizer->denormalize($data['optionalCaveat'], ContextualizedCaveat::class, 'json', $context));
        }
        return $relationship;
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
