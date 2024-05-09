<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\PartialCaveatInfo;
use Chiphpotle\Rest\Model\ResolvedSubject;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class ResolvedSubjectNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === ResolvedSubject::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && $data::class === ResolvedSubject::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): ResolvedSubject
    {
        $object = new ResolvedSubject();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('subjectObjectId', $data)) {
            $object->setSubjectObjectId($data['subjectObjectId']);
        }
        if (\array_key_exists('permissionship', $data)) {
            $object->setPermissionship($data['permissionship']);
        }
        if (\array_key_exists('partialCaveatInfo', $data)) {
            $object->setPartialCaveatInfo($this->denormalizer->denormalize($data['partialCaveatInfo'], PartialCaveatInfo::class, 'json', $context));
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getSubjectObjectId()) {
            $data['subjectObjectId'] = $object->getSubjectObjectId();
        }
        if (null !== $object->getPermissionship()) {
            $data['permissionship'] = $object->getPermissionship();
        }
        if (null !== $object->getPartialCaveatInfo()) {
            $data['partialCaveatInfo'] = $this->normalizer->normalize($object->getPartialCaveatInfo(), 'json', $context);
        }
        return $data;
    }

    public function getSupportedTypes(?string $format = null): array
    {
        return [ResolvedSubject::class => true];
    }
}
