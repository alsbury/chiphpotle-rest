<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\LookupSubjectsResponse;
use Chiphpotle\Rest\Runtime\Normalizer\CheckArray;
use Jane\Component\JsonSchemaRuntime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class LookupSubjectsResponseNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === 'Chiphpotle\\Rest\\Model\\LookupSubjectsResponse';
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return is_object($data) && get_class($data) === 'Chiphpotle\\Rest\\Model\\LookupSubjectsResponse';
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): LookupSubjectsResponse|Reference
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new LookupSubjectsResponse();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('lookedUpAt', $data)) {
            $object->setLookedUpAt($this->denormalizer->denormalize($data['lookedUpAt'], 'Chiphpotle\\Rest\\Model\\ZedToken', 'json', $context));
        }
        if (\array_key_exists('subjectObjectId', $data)) {
            $object->setSubjectObjectId($data['subjectObjectId']);
        }
        if (\array_key_exists('excludedSubjectIds', $data)) {
            $values = [];
            foreach ($data['excludedSubjectIds'] as $value) {
                $values[] = $value;
            }
            $object->setExcludedSubjectIds($values);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): float|int|bool|\ArrayObject|array|string|null
    {
        $data = [];
        if (null !== $object->getLookedUpAt()) {
            $data['lookedUpAt'] = $this->normalizer->normalize($object->getLookedUpAt(), 'json', $context);
        }
        if (null !== $object->getSubjectObjectId()) {
            $data['subjectObjectId'] = $object->getSubjectObjectId();
        }
        if (null !== $object->getExcludedSubjectIds()) {
            $values = [];
            foreach ($object->getExcludedSubjectIds() as $value) {
                $values[] = $value;
            }
            $data['excludedSubjectIds'] = $values;
        }
        return $data;
    }
}
