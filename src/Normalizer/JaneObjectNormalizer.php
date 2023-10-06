<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Runtime\Normalizer\CheckArray;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class JaneObjectNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    protected array $normalizers = ['Chiphpotle\\Rest\\Model\\SubjectFilterRelationFilter' => 'Chiphpotle\\Rest\\Normalizer\\SubjectFilterRelationFilterNormalizer', 'Chiphpotle\\Rest\\Model\\ReadSchemaResponse' => 'Chiphpotle\\Rest\\Normalizer\\ReadSchemaResponseNormalizer', 'Chiphpotle\\Rest\\Model\\WriteSchemaRequest' => 'Chiphpotle\\Rest\\Normalizer\\WriteSchemaRequestNormalizer', 'Chiphpotle\\Rest\\Model\\Apiv1alpha1ReadSchemaResponse' => 'Chiphpotle\\Rest\\Normalizer\\Apiv1alpha1ReadSchemaResponseNormalizer', 'Chiphpotle\\Rest\\Model\\Apiv1alpha1WriteSchemaResponse' => 'Chiphpotle\\Rest\\Normalizer\\Apiv1alpha1WriteSchemaResponseNormalizer', 'Chiphpotle\\Rest\\Model\\ProtobufAny' => 'Chiphpotle\\Rest\\Normalizer\\ProtobufAnyNormalizer', 'Chiphpotle\\Rest\\Model\\RpcStatus' => 'Chiphpotle\\Rest\\Normalizer\\RpcStatusNormalizer', 'Chiphpotle\\Rest\\Model\\V0DeveloperError' => 'Chiphpotle\\Rest\\Normalizer\\V0DeveloperErrorNormalizer', 'Chiphpotle\\Rest\\Model\\V0EditCheckResponse' => 'Chiphpotle\\Rest\\Normalizer\\V0EditCheckResponseNormalizer', 'Chiphpotle\\Rest\\Model\\V0EditCheckResult' => 'Chiphpotle\\Rest\\Normalizer\\V0EditCheckResultNormalizer', 'Chiphpotle\\Rest\\Model\\V0FormatSchemaResponse' => 'Chiphpotle\\Rest\\Normalizer\\V0FormatSchemaResponseNormalizer', 'Chiphpotle\\Rest\\Model\\V0LookupShareResponse' => 'Chiphpotle\\Rest\\Normalizer\\V0LookupShareResponseNormalizer', 'Chiphpotle\\Rest\\Model\\V0ObjectAndRelation' => 'Chiphpotle\\Rest\\Normalizer\\V0ObjectAndRelationNormalizer', 'Chiphpotle\\Rest\\Model\\V0RelationTuple' => 'Chiphpotle\\Rest\\Normalizer\\V0RelationTupleNormalizer', 'Chiphpotle\\Rest\\Model\\V0RequestContext' => 'Chiphpotle\\Rest\\Normalizer\\V0RequestContextNormalizer', 'Chiphpotle\\Rest\\Model\\V0ShareResponse' => 'Chiphpotle\\Rest\\Normalizer\\V0ShareResponseNormalizer', 'Chiphpotle\\Rest\\Model\\V0UpgradeSchemaResponse' => 'Chiphpotle\\Rest\\Normalizer\\V0UpgradeSchemaResponseNormalizer', 'Chiphpotle\\Rest\\Model\\V0User' => 'Chiphpotle\\Rest\\Normalizer\\V0UserNormalizer', 'Chiphpotle\\Rest\\Model\\V0ValidateResponse' => 'Chiphpotle\\Rest\\Normalizer\\V0ValidateResponseNormalizer', 'Chiphpotle\\Rest\\Model\\AlgebraicSubjectSet' => 'Chiphpotle\\Rest\\Normalizer\\AlgebraicSubjectSetNormalizer', 'Chiphpotle\\Rest\\Model\\CheckPermissionRequest' => 'Chiphpotle\\Rest\\Normalizer\\CheckPermissionRequestNormalizer', 'Chiphpotle\\Rest\\Model\\CheckPermissionResponse' => 'Chiphpotle\\Rest\\Normalizer\\CheckPermissionResponseNormalizer', 'Chiphpotle\\Rest\\Model\\Consistency' => 'Chiphpotle\\Rest\\Normalizer\\ConsistencyNormalizer', 'Chiphpotle\\Rest\\Model\\DeleteRelationshipsRequest' => 'Chiphpotle\\Rest\\Normalizer\\DeleteRelationshipsRequestNormalizer', 'Chiphpotle\\Rest\\Model\\DeleteRelationshipsResponse' => 'Chiphpotle\\Rest\\Normalizer\\DeleteRelationshipsResponseNormalizer', 'Chiphpotle\\Rest\\Model\\DirectSubjectSet' => 'Chiphpotle\\Rest\\Normalizer\\DirectSubjectSetNormalizer', 'Chiphpotle\\Rest\\Model\\ExpandPermissionTreeRequest' => 'Chiphpotle\\Rest\\Normalizer\\ExpandPermissionTreeRequestNormalizer', 'Chiphpotle\\Rest\\Model\\ExpandPermissionTreeResponse' => 'Chiphpotle\\Rest\\Normalizer\\ExpandPermissionTreeResponseNormalizer', 'Chiphpotle\\Rest\\Model\\LookupResourcesRequest' => 'Chiphpotle\\Rest\\Normalizer\\LookupResourcesRequestNormalizer', 'Chiphpotle\\Rest\\Model\\LookupResourcesResponse' => 'Chiphpotle\\Rest\\Normalizer\\LookupResourcesResponseNormalizer', 'Chiphpotle\\Rest\\Model\\LookupSubjectsRequest' => 'Chiphpotle\\Rest\\Normalizer\\LookupSubjectsRequestNormalizer', 'Chiphpotle\\Rest\\Model\\LookupSubjectsResponse' => 'Chiphpotle\\Rest\\Normalizer\\LookupSubjectsResponseNormalizer', 'Chiphpotle\\Rest\\Model\\ObjectReference' => 'Chiphpotle\\Rest\\Normalizer\\ObjectReferenceNormalizer', 'Chiphpotle\\Rest\\Model\\PermissionRelationshipTree' => 'Chiphpotle\\Rest\\Normalizer\\PermissionRelationshipTreeNormalizer', 'Chiphpotle\\Rest\\Model\\Precondition' => 'Chiphpotle\\Rest\\Normalizer\\PreconditionNormalizer', 'Chiphpotle\\Rest\\Model\\ReadRelationshipsRequest' => 'Chiphpotle\\Rest\\Normalizer\\ReadRelationshipsRequestNormalizer', 'Chiphpotle\\Rest\\Model\\ReadRelationshipsResponse' => 'Chiphpotle\\Rest\\Normalizer\\ReadRelationshipsResponseNormalizer', 'Chiphpotle\\Rest\\Model\\Relationship' => 'Chiphpotle\\Rest\\Normalizer\\RelationshipNormalizer', 'Chiphpotle\\Rest\\Model\\RelationshipFilter' => 'Chiphpotle\\Rest\\Normalizer\\RelationshipFilterNormalizer', 'Chiphpotle\\Rest\\Model\\RelationshipUpdate' => 'Chiphpotle\\Rest\\Normalizer\\RelationshipUpdateNormalizer', 'Chiphpotle\\Rest\\Model\\SubjectFilter' => 'Chiphpotle\\Rest\\Normalizer\\SubjectFilterNormalizer', 'Chiphpotle\\Rest\\Model\\SubjectReference' => 'Chiphpotle\\Rest\\Normalizer\\SubjectReferenceNormalizer', 'Chiphpotle\\Rest\\Model\\WatchRequest' => 'Chiphpotle\\Rest\\Normalizer\\V1WatchRequestNormalizer', 'Chiphpotle\\Rest\\Model\\WatchResponse' => 'Chiphpotle\\Rest\\Normalizer\\V1WatchResponseNormalizer', 'Chiphpotle\\Rest\\Model\\WriteRelationshipsRequest' => 'Chiphpotle\\Rest\\Normalizer\\WriteRelationshipsRequestNormalizer', 'Chiphpotle\\Rest\\Model\\WriteRelationshipsResponse' => 'Chiphpotle\\Rest\\Normalizer\\WriteRelationshipsResponseNormalizer', 'Chiphpotle\\Rest\\Model\\ZedToken' => 'Chiphpotle\\Rest\\Normalizer\\ZedTokenNormalizer', 'Chiphpotle\\Rest\\Model\\V1alpha1PermissionUpdate' => 'Chiphpotle\\Rest\\Normalizer\\V1alpha1PermissionUpdateNormalizer', 'Chiphpotle\\Rest\\Model\\V1alpha1WatchResourcesRequest' => 'Chiphpotle\\Rest\\Normalizer\\V1alpha1WatchResourcesRequestNormalizer', 'Chiphpotle\\Rest\\Model\\V1alpha1WatchResourcesResponse' => 'Chiphpotle\\Rest\\Normalizer\\V1alpha1WatchResourcesResponseNormalizer', 'Chiphpotle\\Rest\\Model\\PermissionsResourcesPostResponse200' => 'Chiphpotle\\Rest\\Normalizer\\PermissionsResourcesPostResponse200Normalizer', 'Chiphpotle\\Rest\\Model\\PermissionsSubjectsPostResponse200' => 'Chiphpotle\\Rest\\Normalizer\\PermissionsSubjectsPostResponse200Normalizer', 'Chiphpotle\\Rest\\Model\\RelationshipsReadPostResponse200' => 'Chiphpotle\\Rest\\Normalizer\\RelationshipsReadPostResponse200Normalizer', 'Chiphpotle\\Rest\\Model\\WatchPostResponse200' => 'Chiphpotle\\Rest\\Normalizer\\V1WatchPostResponse200Normalizer', 'Chiphpotle\\Rest\\Model\\V1alpha1LookupwatchPostResponse200' => 'Chiphpotle\\Rest\\Normalizer\\V1alpha1LookupwatchPostResponse200Normalizer', '\\Jane\\Component\\JsonSchemaRuntime\\Reference' => '\\Chiphpotle\\Rest\\Runtime\\Normalizer\\ReferenceNormalizer'];

    protected array $normalizersCache = [];

    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return array_key_exists($type, $this->normalizers);
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return is_object($data) && array_key_exists(get_class($data), $this->normalizers);
    }

    public function normalize($object, $format = null, array $context = []): float|int|bool|\ArrayObject|array|string|null
    {
        $normalizerClass = $this->normalizers[get_class($object)];
        $normalizer = $this->getNormalizer($normalizerClass);
        return $normalizer->normalize($object, $format, $context);
    }

    public function denormalize($data, $class, $format = null, array $context = []): mixed
    {
        $denormalizerClass = $this->normalizers[$class];
        $denormalizer = $this->getNormalizer($denormalizerClass);
        return $denormalizer->denormalize($data, $class, $format, $context);
    }

    private function getNormalizer(string $normalizerClass)
    {
        return $this->normalizersCache[$normalizerClass] ?? $this->initNormalizer($normalizerClass);
    }

    private function initNormalizer(string $normalizerClass)
    {
        $normalizer = new $normalizerClass();
        $normalizer->setNormalizer($this->normalizer);
        $normalizer->setDenormalizer($this->denormalizer);
        $this->normalizersCache[$normalizerClass] = $normalizer;
        return $normalizer;
    }
}
