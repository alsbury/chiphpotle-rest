<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\SubjectFilterRelationFilter;
use Chiphpotle\Rest\Runtime\Normalizer\ValidationException;
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
        if (empty($data['relation'])) {
            throw new ValidationException('Missing required relation');
        }
        return new SubjectFilterRelationFilter($data['relation']);
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
