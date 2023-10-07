<?php

namespace Chiphpotle\Rest\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Chiphpotle\Rest\Runtime\Normalizer\CheckArray;
use Chiphpotle\Rest\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class PartialCaveatInfoNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return $type === 'Chiphpotle\\Rest\\Model\\V1PartialCaveatInfo';
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === 'Chiphpotle\\Rest\\Model\\V1PartialCaveatInfo';
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
        $object = new \Chiphpotle\Rest\Model\V1PartialCaveatInfo();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('missingRequiredContext', $data)) {
            $values = [];
            foreach ($data['missingRequiredContext'] as $value) {
                $values[] = $value;
            }
            $object->setMissingRequiredContext($values);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getMissingRequiredContext()) {
            $values = [];
            foreach ($object->getMissingRequiredContext() as $value) {
                $values[] = $value;
            }
            $data['missingRequiredContext'] = $values;
        }
        return $data;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return ['Chiphpotle\\Rest\\Model\\V1PartialCaveatInfo' => false];
    }
}
