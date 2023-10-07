<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\ResolvedSubject;
use Jane\Component\JsonSchemaRuntime\Reference;
use Chiphpotle\Rest\Runtime\Normalizer\CheckArray;
use Chiphpotle\Rest\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ResolvedSubjectNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return $type === 'Chiphpotle\\Rest\\Model\\ResolvedSubject';
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === 'Chiphpotle\\Rest\\Model\\ResolvedSubject';
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): ResolvedSubject|Reference
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new ResolvedSubject();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('subjectObjectId', $data)) {
            $object->setSubjectObjectId($data['subjectObjectId']);
        }
        if (\array_key_exists('permissionship', $data)) {
            $object->setPermissionship($data['permissionship']);
        }
        if (\array_key_exists('partialCaveatInfo', $data)) {
            $object->setPartialCaveatInfo($this->denormalizer->denormalize($data['partialCaveatInfo'], 'Chiphpotle\\Rest\\Model\\V1PartialCaveatInfo', 'json', $context));
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getSubjectObjectId()) {
            $data['subjectObjectId'] = $object->getSubjectObjectId();
        }
        if (null !== $object->getPermissionship()) {
            $data['permissionship'] = $object->getPermissionship();
        }
        if (null !== $object->getPartialCaveatInfo()) {
            $data['partialCaveatInfo'] = $this->normalizer->normalize($object->getPartialCaveatInfo(), 'json', $context);
        }
        return $data;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return ['Chiphpotle\\Rest\\Model\\ResolvedSubject' => false];
    }
}
