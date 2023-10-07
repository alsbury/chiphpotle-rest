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

class WatchResponseNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return $type === 'Chiphpotle\\Rest\\Model\\WatchResponse';
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === 'Chiphpotle\\Rest\\Model\\WatchResponse';
    }

    /**
     * @return mixed
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \Chiphpotle\Rest\Model\WatchResponse();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('updates', $data)) {
            $values = [];
            foreach ($data['updates'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, 'Chiphpotle\\Rest\\Model\\RelationshipUpdate', 'json', $context);
            }
            $object->setUpdates($values);
        }
        if (\array_key_exists('changesThrough', $data)) {
            $object->setChangesThrough($this->denormalizer->denormalize($data['changesThrough'], 'Chiphpotle\\Rest\\Model\\ZedToken', 'json', $context));
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getUpdates()) {
            $values = [];
            foreach ($object->getUpdates() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data['updates'] = $values;
        }
        if (null !== $object->getChangesThrough()) {
            $data['changesThrough'] = $this->normalizer->normalize($object->getChangesThrough(), 'json', $context);
        }
        return $data;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return ['Chiphpotle\\Rest\\Model\\WatchResponse' => false];
    }
}
