<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\Consistency;
use Chiphpotle\Rest\Model\LookupSubjectsRequest;
use ArrayObject;
use Chiphpotle\Rest\Model\ObjectReference;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

use function array_key_exists;
use function is_array;

final class LookupSubjectsRequestNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === LookupSubjectsRequest::class;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return is_object($data) && $data::class === LookupSubjectsRequest::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): LookupSubjectsRequest
    {
        $object = new LookupSubjectsRequest();
        if (null === $data || false === is_array($data)) {
            return $object;
        }
        if (array_key_exists('consistency', $data)) {
            $object->setConsistency($this->denormalizer->denormalize($data['consistency'], Consistency::class, 'json', $context));
        }
        if (array_key_exists('resource', $data)) {
            $object->setResource($this->denormalizer->denormalize($data['resource'], ObjectReference::class, 'json', $context));
        }
        if (array_key_exists('permission', $data)) {
            $object->setPermission($data['permission']);
        }
        if (array_key_exists('subjectObjectType', $data)) {
            $object->setSubjectObjectType($data['subjectObjectType']);
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
}
