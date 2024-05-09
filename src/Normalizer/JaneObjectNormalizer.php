<?php

namespace Chiphpotle\Rest\Normalizer;

use Chiphpotle\Rest\Model;
use Chiphpotle\Rest\Normalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class JaneObjectNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    protected array $normalizers = [
        Model\SubjectFilterRelationFilter::class => Normalizer\SubjectFilterRelationFilterNormalizer::class,
        Model\ReadSchemaResponse::class => Normalizer\ReadSchemaResponseNormalizer::class,
        Model\WriteSchemaRequest::class => Normalizer\WriteSchemaRequestNormalizer::class,
        Model\WriteSchemaResponse::class => Normalizer\WriteSchemaResponseNormalizer::class,
        Model\ProtobufAny::class => Normalizer\ProtobufAnyNormalizer::class,
        Model\RpcStatus::class => Normalizer\RpcStatusNormalizer::class,
        Model\AlgebraicSubjectSet::class => Normalizer\AlgebraicSubjectSetNormalizer::class,
        Model\BulkCheckPermissionPair::class => Normalizer\BulkCheckPermissionPairNormalizer::class,
        Model\BulkCheckPermissionRequest::class => Normalizer\BulkCheckPermissionRequestNormalizer::class,
        Model\BulkCheckPermissionRequestItem::class => Normalizer\BulkCheckPermissionRequestItemNormalizer::class,
        Model\BulkCheckPermissionResponse::class => Normalizer\BulkCheckPermissionResponseNormalizer::class,
        Model\BulkCheckPermissionResponseItem::class => Normalizer\BulkCheckPermissionResponseItemNormalizer::class,
        Model\BulkExportRelationshipsRequest::class => Normalizer\BulkExportRelationshipsRequestNormalizer::class,
        Model\BulkExportRelationshipsResponse::class => Normalizer\BulkExportRelationshipsResponseNormalizer::class,
        Model\BulkImportRelationshipsRequest::class => Normalizer\BulkImportRelationshipsRequestNormalizer::class,
        Model\BulkImportRelationshipsResponse::class => Normalizer\BulkImportRelationshipsResponseNormalizer::class,
        Model\CheckBulkPermissionsPair::class => Normalizer\CheckBulkPermissionsPairNormalizer::class,
        Model\CheckBulkPermissionsRequest::class => Normalizer\CheckBulkPermissionsRequestNormalizer::class,
        Model\CheckBulkPermissionsRequestItem::class => Normalizer\CheckBulkPermissionsRequestItemNormalizer::class,
        Model\CheckBulkPermissionsResponse::class => Normalizer\CheckBulkPermissionsResponseNormalizer::class,
        Model\CheckBulkPermissionsResponseItem::class => Normalizer\CheckBulkPermissionsResponseItemNormalizer::class,
        Model\CheckPermissionRequest::class => Normalizer\CheckPermissionRequestNormalizer::class,
        Model\CheckPermissionResponse::class => Normalizer\CheckPermissionResponseNormalizer::class,
        Model\Consistency::class => Normalizer\ConsistencyNormalizer::class,
        Model\ContextualizedCaveat::class => Normalizer\ContextualizedCaveatNormalizer::class,
        Model\Cursor::class => Normalizer\CursorNormalizer::class,
        Model\DeleteRelationshipsRequest::class => Normalizer\DeleteRelationshipsRequestNormalizer::class,
        Model\DeleteRelationshipsResponse::class => Normalizer\DeleteRelationshipsResponseNormalizer::class,
        Model\DirectSubjectSet::class => Normalizer\DirectSubjectSetNormalizer::class,
        Model\ExpandPermissionTreeRequest::class => Normalizer\ExpandPermissionTreeRequestNormalizer::class,
        Model\ExpandPermissionTreeResponse::class => Normalizer\ExpandPermissionTreeResponseNormalizer::class,
        Model\LookupResourcesRequest::class => Normalizer\LookupResourcesRequestNormalizer::class,
        Model\LookupResourcesResponse::class => Normalizer\LookupResourcesResponseNormalizer::class,
        Model\LookupSubjectsRequest::class => Normalizer\LookupSubjectsRequestNormalizer::class,
        Model\LookupSubjectsResponse::class => Normalizer\LookupSubjectsResponseNormalizer::class,
        Model\ObjectReference::class => Normalizer\ObjectReferenceNormalizer::class,
        Model\PartialCaveatInfo::class => Normalizer\PartialCaveatInfoNormalizer::class,
        Model\PermissionRelationshipTree::class => Normalizer\PermissionRelationshipTreeNormalizer::class,
        Model\Precondition::class => Normalizer\PreconditionNormalizer::class,
        Model\ReadRelationshipsRequest::class => Normalizer\ReadRelationshipsRequestNormalizer::class,
        Model\ReadRelationshipsResponse::class => Normalizer\ReadRelationshipsResponseNormalizer::class,
        Model\Relationship::class => Normalizer\RelationshipNormalizer::class,
        Model\RelationshipFilter::class => Normalizer\RelationshipFilterNormalizer::class,
        Model\RelationshipUpdate::class => Normalizer\RelationshipUpdateNormalizer::class,
        Model\ResolvedSubject::class => Normalizer\ResolvedSubjectNormalizer::class,
        Model\SubjectFilter::class => Normalizer\SubjectFilterNormalizer::class,
        Model\SubjectReference::class => Normalizer\SubjectReferenceNormalizer::class,
        Model\WatchRequest::class => Normalizer\WatchRequestNormalizer::class,
        Model\WatchResponse::class => Normalizer\WatchResponseNormalizer::class,
        Model\WriteRelationshipsRequest::class => Normalizer\WriteRelationshipsRequestNormalizer::class,
        Model\WriteRelationshipsResponse::class => Normalizer\WriteRelationshipsResponseNormalizer::class,
        Model\ZedToken::class => Normalizer\ZedTokenNormalizer::class,
        Model\ExperimentalRelationshipsBulkexportPostResponse200::class => Normalizer\ExperimentalRelationshipsBulkexportPostResponse200Normalizer::class,
        Model\PermissionsResourcesPostResponse200::class => Normalizer\PermissionsResourcesPostResponse200Normalizer::class,
        Model\PermissionsSubjectsPostResponse200::class => Normalizer\PermissionsSubjectsPostResponse200Normalizer::class,
        Model\RelationshipsReadPostResponse200::class => Normalizer\RelationshipsReadPostResponse200Normalizer::class,
        Model\WatchPostResponse200::class => Normalizer\WatchPostResponse200Normalizer::class,
    ];

    protected array $normalizersCache = [];

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return array_key_exists($type, $this->normalizers);
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && array_key_exists($data::class, $this->normalizers);
    }

    public function normalize($object, $format = null, array $context = []): float|int|bool|\ArrayObject|array|string|null
    {
        $normalizerClass = $this->normalizers[$object::class];
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

    public function getSupportedTypes(?string $format): array
    {
        return array_fill_keys(array_keys($this->normalizers), true);
    }
}
