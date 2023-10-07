<?php

namespace Chiphpotle\Rest\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Chiphpotle\Rest\Runtime\Normalizer\CheckArray;
use Chiphpotle\Rest\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class WatchRequestNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return $type === 'Chiphpotle\\Rest\\Model\\WatchRequest';
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === 'Chiphpotle\\Rest\\Model\\WatchRequest';
    }

    /**
     * @return mixed
     */
    public function denormalize($data, $class, $format = null, array $context = []): mixed
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \Chiphpotle\Rest\Model\WatchRequest();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('optionalObjectTypes', $data)) {
            $values = [];
            foreach ($data['optionalObjectTypes'] as $value) {
                $values[] = $value;
            }
            $object->setOptionalObjectTypes($values);
        }
        if (\array_key_exists('optionalStartCursor', $data)) {
            $object->setOptionalStartCursor($this->denormalizer->denormalize($data['optionalStartCursor'], 'Chiphpotle\\Rest\\Model\\ZedToken', 'json', $context));
        }
        return $object;
    }


    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getOptionalObjectTypes()) {
            $values = [];
            foreach ($object->getOptionalObjectTypes() as $value) {
                $values[] = $value;
            }
            $data['optionalObjectTypes'] = $values;
        }
        if (null !== $object->getOptionalStartCursor()) {
            $data['optionalStartCursor'] = $this->normalizer->normalize($object->getOptionalStartCursor(), 'json', $context);
        }
        return $data;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return ['Chiphpotle\\Rest\\Model\\WatchRequest' => false];
    }
}