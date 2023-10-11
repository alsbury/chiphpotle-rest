<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\DeleteRelationshipsRequest;
use Chiphpotle\Rest\Model\Precondition;
use Chiphpotle\Rest\Model\RelationshipFilter;
use Chiphpotle\Rest\Runtime\Normalizer\RequiredDataValidator;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

use function array_key_exists;

final class DeleteRelationshipsRequestNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use RequiredDataValidator;

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === DeleteRelationshipsRequest::class;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return is_object($data) && get_class($data) === DeleteRelationshipsRequest::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): DeleteRelationshipsRequest
    {
        $this->checkRequired($data, ['relationshipFilter']);
        $filter = $this->denormalizer->denormalize($data['relationshipFilter'], RelationshipFilter::class, 'json', $context);
        $object = new DeleteRelationshipsRequest($filter);

        if (array_key_exists('optionalPreconditions', $data)) {
            $values = [];
            foreach ($data['optionalPreconditions'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, Precondition::class, 'json', $context);
            }
            $object->setOptionalPreconditions($values);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getRelationshipFilter()) {
            $data['relationshipFilter'] = $this->normalizer->normalize($object->getRelationshipFilter(), 'json', $context);
        }
        if (null !== $object->getOptionalPreconditions()) {
            $values = [];
            foreach ($object->getOptionalPreconditions() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data['optionalPreconditions'] = $values;
        }
        return $data;
    }
}
