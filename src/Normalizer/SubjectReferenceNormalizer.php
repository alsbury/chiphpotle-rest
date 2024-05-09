<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\ObjectReference;
use Chiphpotle\Rest\Model\SubjectReference;
use Chiphpotle\Rest\Runtime\Normalizer\ValidationException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class SubjectReferenceNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return $type === SubjectReference::class;
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return is_object($data) && $data::class === SubjectReference::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): SubjectReference
    {
        if (empty($data['object'])) {
            throw new ValidationException('Missing required object');
        }

        $object = $this->denormalizer->denormalize($data['object'], ObjectReference::class, 'json', $context);

        $object = new SubjectReference($object);

        if (\array_key_exists('optionalRelation', $data)) {
            $object->setOptionalRelation($data['optionalRelation']);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getObject()) {
            $data['object'] = $this->normalizer->normalize($object->getObject(), 'json', $context);
        }
        if (null !== $object->getOptionalRelation()) {
            $data['optionalRelation'] = $object->getOptionalRelation();
        }
        return $data;
    }
}
