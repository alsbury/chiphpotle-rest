<?php

namespace Chiphpotle\Rest\Normalizer;

use ArrayObject;
use Chiphpotle\Rest\Model\RpcStatus;
use Jane\Component\JsonSchemaRuntime\Reference;
use Chiphpotle\Rest\Runtime\Normalizer\CheckArray;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

use function array_key_exists;
use function is_array;

class RpcStatusNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return $type === 'Chiphpotle\\Rest\\Model\\RpcStatus';
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return is_object($data) && get_class($data) === 'Chiphpotle\\Rest\\Model\\RpcStatus';
    }

    public function denormalize($data, $class, $format = null, array $context = []): mixed
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new RpcStatus();
        if (null === $data || false === is_array($data)) {
            return $object;
        }
        if (array_key_exists('code', $data)) {
            $object->setCode($data['code']);
        }
        if (array_key_exists('message', $data)) {
            $object->setMessage($data['message']);
        }
        if (array_key_exists('details', $data)) {
            $values = [];
            foreach ($data['details'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, 'Chiphpotle\\Rest\\Model\\ProtobufAny', 'json', $context);
            }
            $object->setDetails($values);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = []): float|int|bool|ArrayObject|array|string|null
    {
        $data = [];
        if (null !== $object->getCode()) {
            $data['code'] = $object->getCode();
        }
        if (null !== $object->getMessage()) {
            $data['message'] = $object->getMessage();
        }
        if (null !== $object->getDetails()) {
            $values = [];
            foreach ($object->getDetails() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data['details'] = $values;
        }
        return $data;
    }
}
