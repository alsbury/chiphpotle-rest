<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\PartialCaveatInfo;
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

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === PartialCaveatInfo::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && $data::class === PartialCaveatInfo::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): PartialCaveatInfo
    {
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
        return [PartialCaveatInfo::class => true];
    }
}
