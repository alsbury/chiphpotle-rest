<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\ContextualizedCaveat;
use Chiphpotle\Rest\Model\ObjectReference;
use Chiphpotle\Rest\Model\Relationship;
use Chiphpotle\Rest\Model\SubjectReference;
use Chiphpotle\Rest\Runtime\Normalizer\RequiredDataValidator;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class RelationshipNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use RequiredDataValidator;

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return $type === Relationship::class;
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return is_object($data) && $data::class === Relationship::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): Relationship
    {
        $this->checkRequired($data, ['resource', 'relation', 'subject']);

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

    public function getSupportedTypes(?string $format): array
    {
        return [Relationship::class => true];
    }
}
