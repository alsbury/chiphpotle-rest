<?php

namespace Chiphpotle\Rest\Normalizer;

use ArrayObject;
use Chiphpotle\Rest\Model\ReadSchemaResponse;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

use function array_key_exists;
use function is_array;

final class ReadSchemaResponseNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return $type === ReadSchemaResponse::class;
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return is_object($data) && $data::class === ReadSchemaResponse::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): ReadSchemaResponse
    {
        $object = new ReadSchemaResponse();
        if (null === $data || false === is_array($data)) {
            return $object;
        }
        if (array_key_exists('schemaText', $data)) {
            $object->setSchemaText($data['schemaText']);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): float|int|bool|ArrayObject|array|string|null
    {
        $data = [];
        if (null !== $object->getSchemaText()) {
            $data['schemaText'] = $object->getSchemaText();
        }
        return $data;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [ReadSchemaResponse::class => true];
    }
}
