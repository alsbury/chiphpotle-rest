<?php

namespace Chiphpotle\Rest\Normalizer;

use ArrayObject;
use Chiphpotle\Rest\Model\DeleteRelationshipsRequest;
use Chiphpotle\Rest\Runtime\Normalizer\CheckArray;
use Jane\Component\JsonSchemaRuntime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use function array_key_exists;
use function is_array;

class DeleteRelationshipsRequestNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === 'Chiphpotle\\Rest\\Model\\DeleteRelationshipsRequest';
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return is_object($data) && get_class($data) === 'Chiphpotle\\Rest\\Model\\DeleteRelationshipsRequest';
    }

    public function denormalize($data, $class, $format = null, array $context = []): mixed
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new DeleteRelationshipsRequest();
        if (null === $data || false === is_array($data)) {
            return $object;
        }
        if (array_key_exists('relationshipFilter', $data)) {
            $object->setRelationshipFilter($this->denormalizer->denormalize($data['relationshipFilter'], 'Chiphpotle\\Rest\\Model\\RelationshipFilter', 'json', $context));
        }
        if (array_key_exists('optionalPreconditions', $data)) {
            $values = [];
            foreach ($data['optionalPreconditions'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, 'Chiphpotle\\Rest\\Model\\Precondition', 'json', $context);
            }
            $object->setOptionalPreconditions($values);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): float|int|bool|ArrayObject|array|string|null
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