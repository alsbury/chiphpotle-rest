<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\Consistency;
use Chiphpotle\Rest\Model\ExpandPermissionTreeRequest;
use Chiphpotle\Rest\Model\ObjectReference;
use Chiphpotle\Rest\Runtime\Normalizer\RequiredDataValidator;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

use function array_key_exists;

final class ExpandPermissionTreeRequestNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use RequiredDataValidator;

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === ExpandPermissionTreeRequest::class;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return is_object($data) && $data::class === ExpandPermissionTreeRequest::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): ExpandPermissionTreeRequest
    {
        $this->checkRequired($data, ['resource', 'permission']);

        $resource = $this->denormalizer->denormalize($data['resource'], ObjectReference::class, 'json', $context);
        $permission = $data['permission'];

        $object = new ExpandPermissionTreeRequest($resource, $permission);

        if (array_key_exists('consistency', $data)) {
            $object->setConsistency($this->denormalizer->denormalize($data['consistency'], Consistency::class, 'json', $context));
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getConsistency()) {
            $data['consistency'] = $this->normalizer->normalize($object->getConsistency(), 'json', $context);
        }
        if (null !== $object->getResource()) {
            $data['resource'] = $this->normalizer->normalize($object->getResource(), 'json', $context);
        }
        if (null !== $object->getPermission()) {
            $data['permission'] = $object->getPermission();
        }
        return $data;
    }
}
