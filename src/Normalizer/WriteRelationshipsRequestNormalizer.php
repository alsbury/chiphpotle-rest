<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model\Precondition;
use Chiphpotle\Rest\Model\RelationshipUpdate;
use Chiphpotle\Rest\Model\WriteRelationshipsRequest;
use Jane\Component\JsonSchemaRuntime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

use function array_key_exists;
use function is_array;

final class WriteRelationshipsRequestNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === WriteRelationshipsRequest::class;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return is_object($data) && get_class($data) === WriteRelationshipsRequest::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): WriteRelationshipsRequest|Reference
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new WriteRelationshipsRequest();
        if (null === $data || false === is_array($data)) {
            return $object;
        }
        if (array_key_exists('updates', $data)) {
            $values = [];
            foreach ($data['updates'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, RelationshipUpdate::class, 'json', $context);
            }
            $object->setUpdates($values);
        }
        if (array_key_exists('optionalPreconditions', $data)) {
            $values_1 = [];
            foreach ($data['optionalPreconditions'] as $value_1) {
                $values_1[] = $this->denormalizer->denormalize($value_1, Precondition::class, 'json', $context);
            }
            $object->setOptionalPreconditions($values_1);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): array
    {
        $data = [];
        if (null !== $object->getUpdates()) {
            $values = [];
            foreach ($object->getUpdates() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data['updates'] = $values;
        }
        if (null !== $object->getOptionalPreconditions()) {
            $values_1 = [];
            foreach ($object->getOptionalPreconditions() as $value_1) {
                $values_1[] = $this->normalizer->normalize($value_1, 'json', $context);
            }
            $data['optionalPreconditions'] = $values_1;
        }
        return $data;
    }
}
