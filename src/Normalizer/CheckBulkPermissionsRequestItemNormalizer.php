<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\CheckBulkPermissionsRequestItem;
use Chiphpotle\Rest\Model\ObjectReference;
use Chiphpotle\Rest\Model\SubjectReference;
use Chiphpotle\Rest\Runtime\Normalizer\RequiredDataValidator;
use InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class CheckBulkPermissionsRequestItemNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use RequiredDataValidator;

    public function supportsDenormalization($data, $type, string $format = null, array $context = []): bool
    {
        return $type === CheckBulkPermissionsRequestItem::class;
    }

    public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
    {
        return $data instanceof \Chiphpotle\Rest\Model\CheckBulkPermissionsRequestItem;
    }

    /**
     * @return mixed
     */
    public function denormalize($data, $type, $format = null, array $context = []): CheckBulkPermissionsRequestItem
    {
        $this->checkRequired($data, ['resource', 'permission', 'subject']);

        $resource = $this->denormalizer->denormalize($data['resource'], ObjectReference::class, 'json', $context);
        $permission = $data['permission'];
        $subject = $this->denormalizer->denormalize($data['subject'], SubjectReference::class, 'json', $context);

        if (!empty($missing)) {
            throw new InvalidArgumentException('Missing ' . implode(', ', $missing));
        }

        $object = new CheckBulkPermissionsRequestItem($resource, $permission, $subject);
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('context', $data)) {
            $object->setContext($data['context']);
        }
        return $object;
    }

    public function normalize(mixed $object, ?string $format = null, array $context = []): array
    {
        $data = [];
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

    public function getSupportedTypes(?string $format = null): array
    {
        return [CheckBulkPermissionsRequestItem::class => true];
    }
}
