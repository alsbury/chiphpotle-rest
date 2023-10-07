<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\Consistency;
use ArrayObject;
use Jane\Component\JsonSchemaRuntime\Reference;
use Chiphpotle\Rest\Runtime\Normalizer\CheckArray;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

use function array_key_exists;
use function is_array;

class ConsistencyNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === 'Chiphpotle\\Rest\\Model\\Consistency';
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return is_object($data) && get_class($data) === 'Chiphpotle\\Rest\\Model\\Consistency';
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): Consistency|Reference
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new Consistency();
        if (null === $data || false === is_array($data)) {
            return $object;
        }
        if (array_key_exists('minimizeLatency', $data)) {
            $object->setMinimizeLatency($data['minimizeLatency']);
        }
        if (array_key_exists('atLeastAsFresh', $data)) {
            $object->setAtLeastAsFresh($this->denormalizer->denormalize($data['atLeastAsFresh'], 'Chiphpotle\\Rest\\Model\\ZedToken', 'json', $context));
        }
        if (array_key_exists('atExactSnapshot', $data)) {
            $object->setAtExactSnapshot($this->denormalizer->denormalize($data['atExactSnapshot'], 'Chiphpotle\\Rest\\Model\\ZedToken', 'json', $context));
        }
        if (array_key_exists('fullyConsistent', $data)) {
            $object->setFullyConsistent($data['fullyConsistent']);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): float|int|bool|ArrayObject|array|string|null
    {
        $data = [];
        if (null !== $object->getMinimizeLatency()) {
            $data['minimizeLatency'] = $object->getMinimizeLatency();
        }
        if (null !== $object->getAtLeastAsFresh()) {
            $data['atLeastAsFresh'] = $this->normalizer->normalize($object->getAtLeastAsFresh(), 'json', $context);
        }
        if (null !== $object->getAtExactSnapshot()) {
            $data['atExactSnapshot'] = $this->normalizer->normalize($object->getAtExactSnapshot(), 'json', $context);
        }
        if (null !== $object->getFullyConsistent()) {
            $data['fullyConsistent'] = $object->getFullyConsistent();
        }
        return $data;
    }
}
