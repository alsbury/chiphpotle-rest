<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\Cursor;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class CursorNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return $type === Cursor::class;
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === Cursor::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): Cursor
    {
        $object = new Cursor();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('token', $data)) {
            $object->setToken($data['token']);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getToken()) {
            $data['token'] = $object->getToken();
        }
        return $data;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [Cursor::class => false];
    }
}
