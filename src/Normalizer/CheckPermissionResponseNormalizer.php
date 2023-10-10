<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\CheckPermissionResponse;
use Chiphpotle\Rest\Model\ZedToken;
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

class CheckPermissionResponseNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === CheckPermissionResponse::class;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return is_object($data) && get_class($data) === CheckPermissionResponse::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): CheckPermissionResponse|Reference
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new CheckPermissionResponse();
        if (null === $data || false === is_array($data)) {
            return $object;
        }
        if (array_key_exists('checkedAt', $data)) {
            $object->setCheckedAt($this->denormalizer->denormalize($data['checkedAt'], ZedToken::class, 'json', $context));
        }
        if (array_key_exists('permissionship', $data)) {
            $object->setPermissionship($data['permissionship']);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getCheckedAt()) {
            $data['checkedAt'] = $this->normalizer->normalize($object->getCheckedAt(), 'json', $context);
        }
        if (null !== $object->getPermissionship()) {
            $data['permissionship'] = $object->getPermissionship();
        }
        if (null !== $object->getPartialCaveatInfo()) {
            $data['partialCaveatInfo'] = $this->normalizer->normalize($object->getPartialCaveatInfo(), 'json', $context);
        }
        return $data;
    }
}
