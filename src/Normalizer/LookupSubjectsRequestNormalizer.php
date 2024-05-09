<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\Consistency;
use Chiphpotle\Rest\Model\LookupSubjectsRequest;
use ArrayObject;
use Chiphpotle\Rest\Model\ObjectReference;
use Chiphpotle\Rest\Runtime\Normalizer\RequiredDataValidator;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

use function array_key_exists;

final class LookupSubjectsRequestNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use RequiredDataValidator;

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return $type === LookupSubjectsRequest::class;
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return is_object($data) && $data::class === LookupSubjectsRequest::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): LookupSubjectsRequest
    {
        $this->checkRequired($data, ['resource', 'permission', 'subjectObjectType']);
        $resource = $this->denormalizer->denormalize($data['resource'], ObjectReference::class, 'json', $context);
        $object = new LookupSubjectsRequest($resource, $data['permission'], $data['subjectObjectType']);

        if (array_key_exists('consistency', $data)) {
            $object->setConsistency($this->denormalizer->denormalize($data['consistency'], Consistency::class, 'json', $context));
        }
        if (array_key_exists('optionalSubjectRelation', $data)) {
            $object->setOptionalSubjectRelation($data['optionalSubjectRelation']);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): float|int|bool|ArrayObject|array|string|null
    {
        $data = [];
        if (null !== $object->getConsistency()) {
            $data['consistency'] = $this->normalizer->normalize($object->getConsistency(), 'json', $context);
        }
        if (null !== $object->getResource()) {
            $data['resource'] = $this->normalizer->normalize($object->getResource(), 'json', $context);
        }
        if (null !== $object->getPermission()) {
            $data['permission'] = $object->getPermission();
        }
        if (null !== $object->getSubjectObjectType()) {
            $data['subjectObjectType'] = $object->getSubjectObjectType();
        }
        if (null !== $object->getOptionalSubjectRelation()) {
            $data['optionalSubjectRelation'] = $object->getOptionalSubjectRelation();
        }
        return $data;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [LookupSubjectsRequest::class => true];
    }
}
