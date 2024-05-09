<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\Consistency;
use Chiphpotle\Rest\Model\LookupResourcesRequest;
use Chiphpotle\Rest\Model\SubjectReference;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class LookupResourcesRequestNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === LookupResourcesRequest::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && $data::class === LookupResourcesRequest::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): LookupResourcesRequest
    {
        $object = new LookupResourcesRequest();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('consistency', $data)) {
            $object->setConsistency($this->denormalizer->denormalize($data['consistency'], Consistency::class, 'json', $context));
        }
        if (\array_key_exists('resourceObjectType', $data)) {
            $object->setResourceObjectType($data['resourceObjectType']);
        }
        if (\array_key_exists('permission', $data)) {
            $object->setPermission($data['permission']);
        }
        if (\array_key_exists('subject', $data)) {
            $object->setSubject($this->denormalizer->denormalize($data['subject'], SubjectReference::class, 'json', $context));
        }
        return $object;
    }

    public function normalize(mixed $object, ?string $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getConsistency()) {
            $data['consistency'] = $this->normalizer->normalize($object->getConsistency(), 'json', $context);
        }
        if (null !== $object->getResourceObjectType()) {
            $data['resourceObjectType'] = $object->getResourceObjectType();
        }
        if (null !== $object->getPermission()) {
            $data['permission'] = $object->getPermission();
        }
        if (null !== $object->getSubject()) {
            $data['subject'] = $this->normalizer->normalize($object->getSubject(), 'json', $context);
        }
        return $data;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [LookupResourcesRequest::class => true];
    }
}
