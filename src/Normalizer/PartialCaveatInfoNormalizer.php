<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\PartialCaveatInfo;
use Jane\Component\JsonSchemaRuntime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class PartialCaveatInfoNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return $type === PartialCaveatInfo::class;
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === PartialCaveatInfo::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): PartialCaveatInfo|Reference
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new PartialCaveatInfo();
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
        return [PartialCaveatInfo::class => false];
    }
}
