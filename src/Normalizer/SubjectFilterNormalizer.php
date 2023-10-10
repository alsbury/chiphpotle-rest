<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\SubjectFilter;
use Chiphpotle\Rest\Model\SubjectFilterRelationFilter;
use Jane\Component\JsonSchemaRuntime\Reference;
use Chiphpotle\Rest\Runtime\Normalizer\CheckArray;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class SubjectFilterNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === SubjectFilter::class;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return is_object($data) && get_class($data) === SubjectFilter::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): SubjectFilter|Reference
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new SubjectFilter();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('subjectType', $data)) {
            $object->setSubjectType($data['subjectType']);
        }
        if (\array_key_exists('optionalSubjectId', $data)) {
            $object->setOptionalSubjectId($data['optionalSubjectId']);
        }
        if (\array_key_exists('optionalRelation', $data)) {
            $object->setOptionalRelation($this->denormalizer->denormalize($data['optionalRelation'], SubjectFilterRelationFilter::class, 'json', $context));
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getSubjectType()) {
            $data['subjectType'] = $object->getSubjectType();
        }
        if (null !== $object->getOptionalSubjectId()) {
            $data['optionalSubjectId'] = $object->getOptionalSubjectId();
        }
        if (null !== $object->getOptionalRelation()) {
            $data['optionalRelation'] = $this->normalizer->normalize($object->getOptionalRelation(), 'json', $context);
        }
        return $data;
    }
}
