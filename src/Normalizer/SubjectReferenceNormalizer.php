<?php

namespace Chiphpotle\Rest\Normalizer;

use ArrayObject;
use Chiphpotle\Rest\Model\SubjectReference;
use Chiphpotle\Rest\Runtime\Normalizer\CheckArray;
use Jane\Component\JsonSchemaRuntime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class SubjectReferenceNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === 'Chiphpotle\\Rest\\Model\\SubjectReference';
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return is_object($data) && get_class($data) === 'Chiphpotle\\Rest\\Model\\SubjectReference';
    }

    public function denormalize($data, $class, $format = null, array $context = []): Reference|SubjectReference
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new SubjectReference();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('object', $data)) {
            $object->setObject($this->denormalizer->denormalize($data['object'], 'Chiphpotle\\Rest\\Model\\ObjectReference', 'json', $context));
        }
        if (\array_key_exists('optionalRelation', $data)) {
            $object->setOptionalRelation($data['optionalRelation']);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): float|int|bool|ArrayObject|array|string|null
    {
        $data = [];
        if (null !== $object->getObject()) {
            $data['object'] = $this->normalizer->normalize($object->getObject(), 'json', $context);
        }
        if (null !== $object->getOptionalRelation()) {
            $data['optionalRelation'] = $object->getOptionalRelation();
        }
        return $data;
    }
}
