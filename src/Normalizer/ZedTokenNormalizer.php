<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\ZedToken;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

use function array_key_exists;
use function is_array;

final class ZedTokenNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return $type === ZedToken::class;
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return is_object($data) && $data::class === ZedToken::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): ZedToken
    {
        $object = new ZedToken();
        if (null === $data || false === is_array($data)) {
            return $object;
        }
        if (array_key_exists('token', $data)) {
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

    public function getSupportedTypes(?string $format): array
    {
        return [ZedToken::class => true];
    }
}
