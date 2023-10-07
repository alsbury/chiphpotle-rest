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

class BulkCheckPermissionResponseNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return $type === 'Chiphpotle\\Rest\\Model\\BulkCheckPermissionResponse';
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === 'Chiphpotle\\Rest\\Model\\BulkCheckPermissionResponse';
    }

    public function denormalize($data, $class, $format = null, array $context = []): mixed
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \Chiphpotle\Rest\Model\BulkCheckPermissionResponse();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('checkedAt', $data)) {
            $object->setCheckedAt($this->denormalizer->denormalize($data['checkedAt'], 'Chiphpotle\\Rest\\Model\\ZedToken', 'json', $context));
        }
        if (\array_key_exists('pairs', $data)) {
            $values = [];
            foreach ($data['pairs'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, 'Chiphpotle\\Rest\\Model\\BulkCheckPermissionPair', 'json', $context);
            }
            $object->setPairs($values);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getCheckedAt()) {
            $data['checkedAt'] = $this->normalizer->normalize($object->getCheckedAt(), 'json', $context);
        }
        if (null !== $object->getPairs()) {
            $values = [];
            foreach ($object->getPairs() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data['pairs'] = $values;
        }
        return $data;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return ['Chiphpotle\\Rest\\Model\\BulkCheckPermissionResponse' => false];
    }
}
