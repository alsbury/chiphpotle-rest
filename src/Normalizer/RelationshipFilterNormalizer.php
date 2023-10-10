<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\RelationshipFilter;
use Chiphpotle\Rest\Model\SubjectFilter;
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

class RelationshipFilterNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === RelationshipFilter::class;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return is_object($data) && get_class($data) === RelationshipFilter::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): RelationshipFilter|Reference
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new RelationshipFilter();
        if (null === $data || false === is_array($data)) {
            return $object;
        }
        if (array_key_exists('resourceType', $data)) {
            $object->setResourceType($data['resourceType']);
        }
        if (array_key_exists('optionalResourceId', $data)) {
            $object->setOptionalResourceId($data['optionalResourceId']);
        }
        if (array_key_exists('optionalRelation', $data)) {
            $object->setOptionalRelation($data['optionalRelation']);
        }
        if (array_key_exists('optionalSubjectFilter', $data)) {
            $object->setOptionalSubjectFilter($this->denormalizer->denormalize($data['optionalSubjectFilter'], SubjectFilter::class, 'json', $context));
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getResourceType()) {
            $data['resourceType'] = $object->getResourceType();
        }
        if (null !== $object->getOptionalResourceId()) {
            $data['optionalResourceId'] = $object->getOptionalResourceId();
        }
        if (null !== $object->getOptionalRelation()) {
            $data['optionalRelation'] = $object->getOptionalRelation();
        }
        if (null !== $object->getOptionalSubjectFilter()) {
            $data['optionalSubjectFilter'] = $this->normalizer->normalize($object->getOptionalSubjectFilter(), 'json', $context);
        }
        return $data;
    }
}
