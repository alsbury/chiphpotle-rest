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

    protected array $normalizers = [
        'Chiphpotle\\Rest\\Model\\SubjectFilterRelationFilter' => 'Chiphpotle\\Rest\\Normalizer\\SubjectFilterRelationFilterNormalizer',
        'Chiphpotle\\Rest\\Model\\ReadSchemaResponse' => 'Chiphpotle\\Rest\\Normalizer\\ReadSchemaResponseNormalizer',
        'Chiphpotle\\Rest\\Model\\WriteSchemaRequest' => 'Chiphpotle\\Rest\\Normalizer\\WriteSchemaRequestNormalizer',
        'Chiphpotle\\Rest\\Model\\ProtobufAny' => 'Chiphpotle\\Rest\\Normalizer\\ProtobufAnyNormalizer',
        'Chiphpotle\\Rest\\Model\\RpcStatus' => 'Chiphpotle\\Rest\\Normalizer\\RpcStatusNormalizer',
        'Chiphpotle\\Rest\\Model\\AlgebraicSubjectSet' => 'Chiphpotle\\Rest\\Normalizer\\AlgebraicSubjectSetNormalizer',
        'Chiphpotle\\Rest\\Model\\BulkCheckPermissionPair' => 'Chiphpotle\\Rest\\Normalizer\\BulkCheckPermissionPairNormalizer',
        'Chiphpotle\\Rest\\Model\\BulkCheckPermissionRequest' => 'Chiphpotle\\Rest\\Normalizer\\BulkCheckPermissionRequestNormalizer',
        'Chiphpotle\\Rest\\Model\\BulkCheckPermissionRequestItem' => 'Chiphpotle\\Rest\\Normalizer\\BulkCheckPermissionRequestItemNormalizer',
        'Chiphpotle\\Rest\\Model\\BulkCheckPermissionResponse' => 'Chiphpotle\\Rest\\Normalizer\\BulkCheckPermissionResponseNormalizer',
        'Chiphpotle\\Rest\\Model\\BulkCheckPermissionResponseItem' => 'Chiphpotle\\Rest\\Normalizer\\BulkCheckPermissionResponseItemNormalizer',
        'Chiphpotle\\Rest\\Model\\BulkExportRelationshipsRequest' => 'Chiphpotle\\Rest\\Normalizer\\BulkExportRelationshipsRequestNormalizer',
        'Chiphpotle\\Rest\\Model\\BulkExportRelationshipsResponse' => 'Chiphpotle\\Rest\\Normalizer\\BulkExportRelationshipsResponseNormalizer',
        'Chiphpotle\\Rest\\Model\\BulkImportRelationshipsRequest' => 'Chiphpotle\\Rest\\Normalizer\\BulkImportRelationshipsRequestNormalizer',
        'Chiphpotle\\Rest\\Model\\BulkImportRelationshipsResponse' => 'Chiphpotle\\Rest\\Normalizer\\BulkImportRelationshipsResponseNormalizer',
        'Chiphpotle\\Rest\\Model\\CheckPermissionRequest' => 'Chiphpotle\\Rest\\Normalizer\\CheckPermissionRequestNormalizer',
        'Chiphpotle\\Rest\\Model\\CheckPermissionResponse' => 'Chiphpotle\\Rest\\Normalizer\\CheckPermissionResponseNormalizer',
        'Chiphpotle\\Rest\\Model\\Consistency' => 'Chiphpotle\\Rest\\Normalizer\\ConsistencyNormalizer',
        'Chiphpotle\\Rest\\Model\\ContextualizedCaveat' => 'Chiphpotle\\Rest\\Normalizer\\ContextualizedCaveatNormalizer',
        'Chiphpotle\\Rest\\Model\\Cursor' => 'Chiphpotle\\Rest\\Normalizer\\CursorNormalizer',
        'Chiphpotle\\Rest\\Model\\DeleteRelationshipsRequest' => 'Chiphpotle\\Rest\\Normalizer\\DeleteRelationshipsRequestNormalizer',
        'Chiphpotle\\Rest\\Model\\DeleteRelationshipsResponse' => 'Chiphpotle\\Rest\\Normalizer\\DeleteRelationshipsResponseNormalizer',
        'Chiphpotle\\Rest\\Model\\DirectSubjectSet' => 'Chiphpotle\\Rest\\Normalizer\\DirectSubjectSetNormalizer',
        'Chiphpotle\\Rest\\Model\\ExpandPermissionTreeRequest' => 'Chiphpotle\\Rest\\Normalizer\\ExpandPermissionTreeRequestNormalizer',
        'Chiphpotle\\Rest\\Model\\ExpandPermissionTreeResponse' => 'Chiphpotle\\Rest\\Normalizer\\ExpandPermissionTreeResponseNormalizer',
        'Chiphpotle\\Rest\\Model\\LookupResourcesRequest' => 'Chiphpotle\\Rest\\Normalizer\\LookupResourcesRequestNormalizer',
        'Chiphpotle\\Rest\\Model\\LookupResourcesResponse' => 'Chiphpotle\\Rest\\Normalizer\\LookupResourcesResponseNormalizer',
        'Chiphpotle\\Rest\\Model\\LookupSubjectsRequest' => 'Chiphpotle\\Rest\\Normalizer\\LookupSubjectsRequestNormalizer',
        'Chiphpotle\\Rest\\Model\\LookupSubjectsResponse' => 'Chiphpotle\\Rest\\Normalizer\\LookupSubjectsResponseNormalizer',
        'Chiphpotle\\Rest\\Model\\ObjectReference' => 'Chiphpotle\\Rest\\Normalizer\\ObjectReferenceNormalizer',
        'Chiphpotle\\Rest\\Model\\PartialCaveatInfo' => 'Chiphpotle\\Rest\\Normalizer\\PartialCaveatInfoNormalizer',
        'Chiphpotle\\Rest\\Model\\PermissionRelationshipTree' => 'Chiphpotle\\Rest\\Normalizer\\PermissionRelationshipTreeNormalizer',
        'Chiphpotle\\Rest\\Model\\Precondition' => 'Chiphpotle\\Rest\\Normalizer\\PreconditionNormalizer',
        'Chiphpotle\\Rest\\Model\\ReadRelationshipsRequest' => 'Chiphpotle\\Rest\\Normalizer\\ReadRelationshipsRequestNormalizer',
        'Chiphpotle\\Rest\\Model\\ReadRelationshipsResponse' => 'Chiphpotle\\Rest\\Normalizer\\ReadRelationshipsResponseNormalizer',
        'Chiphpotle\\Rest\\Model\\Relationship' => 'Chiphpotle\\Rest\\Normalizer\\RelationshipNormalizer',
        'Chiphpotle\\Rest\\Model\\RelationshipFilter' => 'Chiphpotle\\Rest\\Normalizer\\RelationshipFilterNormalizer',
        'Chiphpotle\\Rest\\Model\\RelationshipUpdate' => 'Chiphpotle\\Rest\\Normalizer\\RelationshipUpdateNormalizer',
        'Chiphpotle\\Rest\\Model\\ResolvedSubject' => 'Chiphpotle\\Rest\\Normalizer\\ResolvedSubjectNormalizer',
        'Chiphpotle\\Rest\\Model\\SubjectFilter' => 'Chiphpotle\\Rest\\Normalizer\\SubjectFilterNormalizer',
        'Chiphpotle\\Rest\\Model\\SubjectReference' => 'Chiphpotle\\Rest\\Normalizer\\SubjectReferenceNormalizer',
        'Chiphpotle\\Rest\\Model\\WatchRequest' => 'Chiphpotle\\Rest\\Normalizer\\WatchRequestNormalizer',
        'Chiphpotle\\Rest\\Model\\WatchResponse' => 'Chiphpotle\\Rest\\Normalizer\\WatchResponseNormalizer',
        'Chiphpotle\\Rest\\Model\\WriteRelationshipsRequest' => 'Chiphpotle\\Rest\\Normalizer\\WriteRelationshipsRequestNormalizer',
        'Chiphpotle\\Rest\\Model\\WriteRelationshipsResponse' => 'Chiphpotle\\Rest\\Normalizer\\WriteRelationshipsResponseNormalizer',
        'Chiphpotle\\Rest\\Model\\ZedToken' => 'Chiphpotle\\Rest\\Normalizer\\ZedTokenNormalizer',
        'Chiphpotle\\Rest\\Model\\ExperimentalRelationshipsBulkexportPostResponse200' => 'Chiphpotle\\Rest\\Normalizer\\ExperimentalRelationshipsBulkexportPostResponse200Normalizer',
        'Chiphpotle\\Rest\\Model\\PermissionsResourcesPostResponse200' => 'Chiphpotle\\Rest\\Normalizer\\PermissionsResourcesPostResponse200Normalizer',
        'Chiphpotle\\Rest\\Model\\PermissionsSubjectsPostResponse200' => 'Chiphpotle\\Rest\\Normalizer\\PermissionsSubjectsPostResponse200Normalizer',
        'Chiphpotle\\Rest\\Model\\RelationshipsReadPostResponse200' => 'Chiphpotle\\Rest\\Normalizer\\RelationshipsReadPostResponse200Normalizer',
        'Chiphpotle\\Rest\\Model\\WatchPostResponse200' => 'Chiphpotle\\Rest\\Normalizer\\WatchPostResponse200Normalizer',
        '\\Jane\\Component\\JsonSchemaRuntime\\Reference' => '\\Chiphpotle\\Rest\\Runtime\\Normalizer\\ReferenceNormalizer'
    ];

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

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
    {
        $denormalizerClass = $this->normalizers[$type];
        $denormalizer = $this->getNormalizer($denormalizerClass);
        return $denormalizer->denormalize($data, $type, $format, $context);
    }

    private function getNormalizer(string $normalizerClass)
    {
        return $this->normalizersCache[$normalizerClass] ?? $this->initNormalizer($normalizerClass);
    }

    private function initNormalizer(string $normalizerClass): object
    {
        $normalizer = new $normalizerClass();
        $normalizer->setNormalizer($this->normalizer);
        $normalizer->setDenormalizer($this->denormalizer);
        $this->normalizersCache[$normalizerClass] = $normalizer;
        return $normalizer;
    }
}
