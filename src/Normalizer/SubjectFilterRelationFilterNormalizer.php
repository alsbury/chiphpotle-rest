<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\SubjectFilterRelationFilter;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class SubjectFilterRelationFilterNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
    {
        return $type === SubjectFilterRelationFilter::class;
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return is_object($data) && $data::class === SubjectFilterRelationFilter::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): SubjectFilterRelationFilter
    {
        $object = new SubjectFilterRelationFilter();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('relation', $data)) {
            $object->setRelation($data['relation']);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getRelation()) {
            $data['relation'] = $object->getRelation();
        }
        return $data;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [SubjectFilterRelationFilter::class => true];
    }
}
