<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\BulkCheckPermissionRequestItem;
use Chiphpotle\Rest\Model\ObjectReference;
use Chiphpotle\Rest\Model\SubjectReference;
use Jane\Component\JsonSchemaRuntime\Reference;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class BulkCheckPermissionRequestItemNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return $type === BulkCheckPermissionRequestItem::class;
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === BulkCheckPermissionRequestItem::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): BulkCheckPermissionRequestItem|Reference
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }

        $missing = [];
        $resource = null;
        $permission = null;
        $subject = null;
        if (\array_key_exists('resource', $data)) {
            $resource = $this->denormalizer->denormalize($data['resource'], ObjectReference::class, 'json', $context);
        } else {
            $missing[] = 'resource';
        }

        if (\array_key_exists('permission', $data)) {
            $permission = $data['permission'];
        } else {
            $missing[] = 'permission';
        }

        if (\array_key_exists('subject', $data)) {
            $subject = $this->denormalizer->denormalize($data['subject'], SubjectReference::class, 'json', $context);
        } else {
            $missing[] = 'subject';
        }

        if (!empty($missing)) {
            throw new InvalidArgumentException('Missing ' . implode(', ', $missing));
        }

        $object = new BulkCheckPermissionRequestItem($resource, $permission, $subject);
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('context', $data)) {
            $object->setContext($data['context']);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
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
        return [BulkCheckPermissionRequestItem::class => false];
    }
}
