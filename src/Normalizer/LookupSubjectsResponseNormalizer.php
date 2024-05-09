<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\LookupSubjectsResponse;
use Chiphpotle\Rest\Model\ZedToken;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class LookupSubjectsResponseNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === LookupSubjectsResponse::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && $data::class === LookupSubjectsResponse::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): LookupSubjectsResponse
    {
        $object = new LookupSubjectsResponse();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('lookedUpAt', $data)) {
            $object->setLookedUpAt($this->denormalizer->denormalize($data['lookedUpAt'], ZedToken::class, 'json', $context));
        }
        if (\array_key_exists('subjectObjectId', $data)) {
            $object->setSubjectObjectId($data['subjectObjectId']);
        }
        if (\array_key_exists('excludedSubjectIds', $data)) {
            $values = [];
            foreach ($data['excludedSubjectIds'] as $value) {
                $values[] = $value;
            }
            $object->setExcludedSubjectIds($values);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getLookedUpAt()) {
            $data['lookedUpAt'] = $this->normalizer->normalize($object->getLookedUpAt(), 'json', $context);
        }
        if (null !== $object->getSubjectObjectId()) {
            $data['subjectObjectId'] = $object->getSubjectObjectId();
        }
        if (null !== $object->getExcludedSubjectIds()) {
            $values = [];
            foreach ($object->getExcludedSubjectIds() as $value) {
                $values[] = $value;
            }
            $data['excludedSubjectIds'] = $values;
        }
        return $data;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [LookupSubjectsResponse::class => true];
    }
}
