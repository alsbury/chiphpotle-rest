<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\CheckPermissionRequest;
use Chiphpotle\Rest\Model\Consistency;
use Chiphpotle\Rest\Model\ObjectReference;
use Chiphpotle\Rest\Model\SubjectReference;
use Chiphpotle\Rest\Runtime\Normalizer\RequiredDataValidator;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

use function array_key_exists;

final class CheckPermissionRequestNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use RequiredDataValidator;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === CheckPermissionRequest::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && $data::class === CheckPermissionRequest::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): CheckPermissionRequest
    {
        $this->checkRequired($data, ['resource', 'permission', 'subject']);

        $resource = $this->denormalizer->denormalize($data['resource'], ObjectReference::class, 'json', $context);
        $permission = $data['permission'];
        $subject = $this->denormalizer->denormalize($data['subject'], SubjectReference::class, 'json', $context);

        $object = new CheckPermissionRequest($resource, $permission, $subject);
        if (array_key_exists('consistency', $data)) {
            $object->setConsistency($this->denormalizer->denormalize($data['consistency'], Consistency::class, 'json', $context));
        }
        if (array_key_exists('context', $data)) {
            $object->setContext($data['context']);
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
        if (null !== $object->getSubject()) {
            $data['subject'] = $this->normalizer->normalize($object->getSubject(), 'json', $context);
        }
        if (null !== $object->getContext()) {
            $data['context'] = $object->getContext();
        }
        return $data;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [CheckPermissionRequest::class => true];
    }
}
