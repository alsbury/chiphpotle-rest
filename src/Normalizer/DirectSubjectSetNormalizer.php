<?php

namespace Chiphpotle\Rest\Normalizer;

use ArrayObject;
use Chiphpotle\Rest\Model\DirectSubjectSet;
use Chiphpotle\Rest\Model\SubjectReference;
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

final class DirectSubjectSetNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === DirectSubjectSet::class;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return is_object($data) && get_class($data) === DirectSubjectSet::class;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): DirectSubjectSet|Reference
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new DirectSubjectSet();
        if (null === $data || false === is_array($data)) {
            return $object;
        }
        if (array_key_exists('subjects', $data)) {
            $values = [];
            foreach ($data['subjects'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, SubjectReference::class, 'json', $context);
            }
            $object->setSubjects($values);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): float|int|bool|ArrayObject|array|string|null
    {
        $data = [];
        if (null !== $object->getSubjects()) {
            $values = [];
            foreach ($object->getSubjects() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data['subjects'] = $values;
        }
        return $data;
    }
}
