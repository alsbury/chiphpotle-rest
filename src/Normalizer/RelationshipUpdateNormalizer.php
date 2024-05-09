<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Enum\UpdateOperation;
use Chiphpotle\Rest\Model\Relationship;
use Chiphpotle\Rest\Model\RelationshipUpdate;
use Chiphpotle\Rest\Runtime\Normalizer\RequiredDataValidator;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class RelationshipUpdateNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use RequiredDataValidator;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === RelationshipUpdate::class;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && $data::class === RelationshipUpdate::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): RelationshipUpdate
    {
        $this->checkRequired($data, ['operation', 'relationship']);
        $relationship = $this->denormalizer->denormalize($data['relationship'], Relationship::class, 'json', $context);
        return new RelationshipUpdate(UpdateOperation::from($data['operation']), $relationship);
    }

    public function normalize(mixed $object, ?string $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getOperation()) {
            $data['operation'] = $object->getOperation();
        }
        if (null !== $object->getRelationship()) {
            $data['relationship'] = $this->normalizer->normalize($object->getRelationship(), 'json', $context);
        }
        return $data;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [RelationshipUpdate::class => true];
    }
}
