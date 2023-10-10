<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\ContextualizedCaveat;
use Chiphpotle\Rest\Runtime\Normalizer\ValidationException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class ContextualizedCaveatNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return $type === ContextualizedCaveat::class;
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === ContextualizedCaveat::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): ContextualizedCaveat
    {
        if (empty($data['caveatName'])) {
            throw new ValidationException('Missing required caveatName');
        }

        $object = new ContextualizedCaveat($data['caveatName']);

        if (\array_key_exists('context', $data)) {
            $object->setContext($data['context']);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getCaveatName()) {
            $data['caveatName'] = $object->getCaveatName();
        }
        if (null !== $object->getContext()) {
            $data['context'] = $object->getContext();
        }
        return $data;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [ContextualizedCaveat::class => false];
    }
}
