<?php

namespace Silverstripe\Search\Client\Normalizer;

use Silverstripe\Search\Client\Runtime\Normalizer\CheckArray;
use Silverstripe\Search\Client\Runtime\Normalizer\ValidatorTrait;
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
    use ValidatorTrait;
    protected $normalizers = [
        
        \Silverstripe\Search\Client\Model\BoostGetResponse::class => \Silverstripe\Search\Client\Normalizer\BoostGetResponseNormalizer::class,
        
        \Silverstripe\Search\Client\Model\BoostPatchRequest::class => \Silverstripe\Search\Client\Normalizer\BoostPatchRequestNormalizer::class,
        
        \Silverstripe\Search\Client\Model\BoostPostRequest::class => \Silverstripe\Search\Client\Normalizer\BoostPostRequestNormalizer::class,
        
        \Silverstripe\Search\Client\Model\BoostPostResponse::class => \Silverstripe\Search\Client\Normalizer\BoostPostResponseNormalizer::class,
        
        \Silverstripe\Search\Client\Model\ClickRequest::class => \Silverstripe\Search\Client\Normalizer\ClickRequestNormalizer::class,
        
        \Silverstripe\Search\Client\Model\Coordinate::class => \Silverstripe\Search\Client\Normalizer\CoordinateNormalizer::class,
        
        \Silverstripe\Search\Client\Model\DocumentField::class => \Silverstripe\Search\Client\Normalizer\DocumentFieldNormalizer::class,
        
        \Silverstripe\Search\Client\Model\DocumentListPagination::class => \Silverstripe\Search\Client\Normalizer\DocumentListPaginationNormalizer::class,
        
        \Silverstripe\Search\Client\Model\DocumentListRequest::class => \Silverstripe\Search\Client\Normalizer\DocumentListRequestNormalizer::class,
        
        \Silverstripe\Search\Client\Model\DocumentListResponse::class => \Silverstripe\Search\Client\Normalizer\DocumentListResponseNormalizer::class,
        
        \Silverstripe\Search\Client\Model\DocumentListResponseMeta::class => \Silverstripe\Search\Client\Normalizer\DocumentListResponseMetaNormalizer::class,
        
        \Silverstripe\Search\Client\Model\DocumentPostPatchResponse::class => \Silverstripe\Search\Client\Normalizer\DocumentPostPatchResponseNormalizer::class,
        
        \Silverstripe\Search\Client\Model\DocumentResponseMeta::class => \Silverstripe\Search\Client\Normalizer\DocumentResponseMetaNormalizer::class,
        
        \Silverstripe\Search\Client\Model\DocumentsDeleteResponse::class => \Silverstripe\Search\Client\Normalizer\DocumentsDeleteResponseNormalizer::class,
        
        \Silverstripe\Search\Client\Model\EngineName::class => \Silverstripe\Search\Client\Normalizer\EngineNameNormalizer::class,
        
        \Silverstripe\Search\Client\Model\EnginesResponse::class => \Silverstripe\Search\Client\Normalizer\EnginesResponseNormalizer::class,
        
        \Silverstripe\Search\Client\Model\FacetResponse::class => \Silverstripe\Search\Client\Normalizer\FacetResponseNormalizer::class,
        
        \Silverstripe\Search\Client\Model\FilterObjectLevel1::class => \Silverstripe\Search\Client\Normalizer\FilterObjectLevel1Normalizer::class,
        
        \Silverstripe\Search\Client\Model\FilterObjectLevel2::class => \Silverstripe\Search\Client\Normalizer\FilterObjectLevel2Normalizer::class,
        
        \Silverstripe\Search\Client\Model\FilterObjectLevel3::class => \Silverstripe\Search\Client\Normalizer\FilterObjectLevel3Normalizer::class,
        
        \Silverstripe\Search\Client\Model\FilterObjectLevel4::class => \Silverstripe\Search\Client\Normalizer\FilterObjectLevel4Normalizer::class,
        
        \Silverstripe\Search\Client\Model\Filters::class => \Silverstripe\Search\Client\Normalizer\FiltersNormalizer::class,
        
        \Silverstripe\Search\Client\Model\Geo::class => \Silverstripe\Search\Client\Normalizer\GeoNormalizer::class,
        
        \Silverstripe\Search\Client\Model\Geolocation::class => \Silverstripe\Search\Client\Normalizer\GeolocationNormalizer::class,
        
        \Silverstripe\Search\Client\Model\HTTPValidationError::class => \Silverstripe\Search\Client\Normalizer\HTTPValidationErrorNormalizer::class,
        
        \Silverstripe\Search\Client\Model\PaginationResponse::class => \Silverstripe\Search\Client\Normalizer\PaginationResponseNormalizer::class,
        
        \Silverstripe\Search\Client\Model\PostResponse::class => \Silverstripe\Search\Client\Normalizer\PostResponseNormalizer::class,
        
        \Silverstripe\Search\Client\Model\QuerySuggestionRequest::class => \Silverstripe\Search\Client\Normalizer\QuerySuggestionRequestNormalizer::class,
        
        \Silverstripe\Search\Client\Model\QuerySuggestionResponse::class => \Silverstripe\Search\Client\Normalizer\QuerySuggestionResponseNormalizer::class,
        
        \Silverstripe\Search\Client\Model\QuerySuggestionResponseValue::class => \Silverstripe\Search\Client\Normalizer\QuerySuggestionResponseValueNormalizer::class,
        
        \Silverstripe\Search\Client\Model\Range::class => \Silverstripe\Search\Client\Normalizer\RangeNormalizer::class,
        
        \Silverstripe\Search\Client\Model\RequestFacetRange::class => \Silverstripe\Search\Client\Normalizer\RequestFacetRangeNormalizer::class,
        
        \Silverstripe\Search\Client\Model\RequestFacetRangeObject::class => \Silverstripe\Search\Client\Normalizer\RequestFacetRangeObjectNormalizer::class,
        
        \Silverstripe\Search\Client\Model\RequestFacetValue::class => \Silverstripe\Search\Client\Normalizer\RequestFacetValueNormalizer::class,
        
        \Silverstripe\Search\Client\Model\ResponseAcknowledged::class => \Silverstripe\Search\Client\Normalizer\ResponseAcknowledgedNormalizer::class,
        
        \Silverstripe\Search\Client\Model\ResponseConfirm::class => \Silverstripe\Search\Client\Normalizer\ResponseConfirmNormalizer::class,
        
        \Silverstripe\Search\Client\Model\ResponseFacetRange::class => \Silverstripe\Search\Client\Normalizer\ResponseFacetRangeNormalizer::class,
        
        \Silverstripe\Search\Client\Model\ResponseFacetValue::class => \Silverstripe\Search\Client\Normalizer\ResponseFacetValueNormalizer::class,
        
        \Silverstripe\Search\Client\Model\ResponseSuccess::class => \Silverstripe\Search\Client\Normalizer\ResponseSuccessNormalizer::class,
        
        \Silverstripe\Search\Client\Model\Schema::class => \Silverstripe\Search\Client\Normalizer\SchemaNormalizer::class,
        
        \Silverstripe\Search\Client\Model\SchemaGetResponse::class => \Silverstripe\Search\Client\Normalizer\SchemaGetResponseNormalizer::class,
        
        \Silverstripe\Search\Client\Model\SearchRequest::class => \Silverstripe\Search\Client\Normalizer\SearchRequestNormalizer::class,
        
        \Silverstripe\Search\Client\Model\SearchRequestBoost::class => \Silverstripe\Search\Client\Normalizer\SearchRequestBoostNormalizer::class,
        
        \Silverstripe\Search\Client\Model\SearchRequestPagination::class => \Silverstripe\Search\Client\Normalizer\SearchRequestPaginationNormalizer::class,
        
        \Silverstripe\Search\Client\Model\SearchRequestResultField::class => \Silverstripe\Search\Client\Normalizer\SearchRequestResultFieldNormalizer::class,
        
        \Silverstripe\Search\Client\Model\SearchRequestResultFieldRaw::class => \Silverstripe\Search\Client\Normalizer\SearchRequestResultFieldRawNormalizer::class,
        
        \Silverstripe\Search\Client\Model\SearchRequestResultFieldSnippet::class => \Silverstripe\Search\Client\Normalizer\SearchRequestResultFieldSnippetNormalizer::class,
        
        \Silverstripe\Search\Client\Model\SearchRequestSearchFieldsWeight::class => \Silverstripe\Search\Client\Normalizer\SearchRequestSearchFieldsWeightNormalizer::class,
        
        \Silverstripe\Search\Client\Model\SearchResponse::class => \Silverstripe\Search\Client\Normalizer\SearchResponseNormalizer::class,
        
        \Silverstripe\Search\Client\Model\SearchResponseEngine::class => \Silverstripe\Search\Client\Normalizer\SearchResponseEngineNormalizer::class,
        
        \Silverstripe\Search\Client\Model\SearchResponseMeta::class => \Silverstripe\Search\Client\Normalizer\SearchResponseMetaNormalizer::class,
        
        \Silverstripe\Search\Client\Model\SettingsRequest::class => \Silverstripe\Search\Client\Normalizer\SettingsRequestNormalizer::class,
        
        \Silverstripe\Search\Client\Model\SettingsResponse::class => \Silverstripe\Search\Client\Normalizer\SettingsResponseNormalizer::class,
        
        \Silverstripe\Search\Client\Model\SpellingSuggestionRequest::class => \Silverstripe\Search\Client\Normalizer\SpellingSuggestionRequestNormalizer::class,
        
        \Silverstripe\Search\Client\Model\SpellingSuggestionResponse::class => \Silverstripe\Search\Client\Normalizer\SpellingSuggestionResponseNormalizer::class,
        
        \Silverstripe\Search\Client\Model\SynonymRule::class => \Silverstripe\Search\Client\Normalizer\SynonymRuleNormalizer::class,
        
        \Silverstripe\Search\Client\Model\SynonymRuleRequest::class => \Silverstripe\Search\Client\Normalizer\SynonymRuleRequestNormalizer::class,
        
        \Silverstripe\Search\Client\Model\Tags::class => \Silverstripe\Search\Client\Normalizer\TagsNormalizer::class,
        
        \Silverstripe\Search\Client\Model\ValidationError::class => \Silverstripe\Search\Client\Normalizer\ValidationErrorNormalizer::class,
        
        \Silverstripe\Search\Client\Model\CommonModelsCurationGetResponseGetResponse::class => \Silverstripe\Search\Client\Normalizer\CommonModelsCurationGetResponseGetResponseNormalizer::class,
        
        \Silverstripe\Search\Client\Model\CommonModelsCurationPatchRequestPatchRequest::class => \Silverstripe\Search\Client\Normalizer\CommonModelsCurationPatchRequestPatchRequestNormalizer::class,
        
        \Silverstripe\Search\Client\Model\CommonModelsCurationPostRequestPostRequest::class => \Silverstripe\Search\Client\Normalizer\CommonModelsCurationPostRequestPostRequestNormalizer::class,
        
        \Silverstripe\Search\Client\Model\CommonModelsCurationDocumentGetResponseGetResponse::class => \Silverstripe\Search\Client\Normalizer\CommonModelsCurationDocumentGetResponseGetResponseNormalizer::class,
        
        \Silverstripe\Search\Client\Model\CommonModelsCurationDocumentPatchRequestPatchRequest::class => \Silverstripe\Search\Client\Normalizer\CommonModelsCurationDocumentPatchRequestPatchRequestNormalizer::class,
        
        \Silverstripe\Search\Client\Model\CommonModelsCurationDocumentPostRequestPostRequest::class => \Silverstripe\Search\Client\Normalizer\CommonModelsCurationDocumentPostRequestPostRequestNormalizer::class,
        
        \Silverstripe\Search\Client\Model\CommonModelsCurationQueryGetResponseGetResponse::class => \Silverstripe\Search\Client\Normalizer\CommonModelsCurationQueryGetResponseGetResponseNormalizer::class,
        
        \Silverstripe\Search\Client\Model\CommonModelsCurationQueryPostRequestPostRequest::class => \Silverstripe\Search\Client\Normalizer\CommonModelsCurationQueryPostRequestPostRequestNormalizer::class,
        
        \Jane\Component\JsonSchemaRuntime\Reference::class => \Silverstripe\Search\Client\Runtime\Normalizer\ReferenceNormalizer::class,
    ], $normalizersCache = [];
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return array_key_exists($type, $this->normalizers);
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && array_key_exists(get_class($data), $this->normalizers);
    }
    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $normalizerClass = $this->normalizers[get_class($data)];
        $normalizer = $this->getNormalizer($normalizerClass);
        return $normalizer->normalize($data, $format, $context);
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $denormalizerClass = $this->normalizers[$type];
        $denormalizer = $this->getNormalizer($denormalizerClass);
        return $denormalizer->denormalize($data, $type, $format, $context);
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
    public function getSupportedTypes(?string $format = null): array
    {
        return [
            
            \Silverstripe\Search\Client\Model\BoostGetResponse::class => false,
            \Silverstripe\Search\Client\Model\BoostPatchRequest::class => false,
            \Silverstripe\Search\Client\Model\BoostPostRequest::class => false,
            \Silverstripe\Search\Client\Model\BoostPostResponse::class => false,
            \Silverstripe\Search\Client\Model\ClickRequest::class => false,
            \Silverstripe\Search\Client\Model\Coordinate::class => false,
            \Silverstripe\Search\Client\Model\DocumentField::class => false,
            \Silverstripe\Search\Client\Model\DocumentListPagination::class => false,
            \Silverstripe\Search\Client\Model\DocumentListRequest::class => false,
            \Silverstripe\Search\Client\Model\DocumentListResponse::class => false,
            \Silverstripe\Search\Client\Model\DocumentListResponseMeta::class => false,
            \Silverstripe\Search\Client\Model\DocumentPostPatchResponse::class => false,
            \Silverstripe\Search\Client\Model\DocumentResponseMeta::class => false,
            \Silverstripe\Search\Client\Model\DocumentsDeleteResponse::class => false,
            \Silverstripe\Search\Client\Model\EngineName::class => false,
            \Silverstripe\Search\Client\Model\EnginesResponse::class => false,
            \Silverstripe\Search\Client\Model\FacetResponse::class => false,
            \Silverstripe\Search\Client\Model\FilterObjectLevel1::class => false,
            \Silverstripe\Search\Client\Model\FilterObjectLevel2::class => false,
            \Silverstripe\Search\Client\Model\FilterObjectLevel3::class => false,
            \Silverstripe\Search\Client\Model\FilterObjectLevel4::class => false,
            \Silverstripe\Search\Client\Model\Filters::class => false,
            \Silverstripe\Search\Client\Model\Geo::class => false,
            \Silverstripe\Search\Client\Model\Geolocation::class => false,
            \Silverstripe\Search\Client\Model\HTTPValidationError::class => false,
            \Silverstripe\Search\Client\Model\PaginationResponse::class => false,
            \Silverstripe\Search\Client\Model\PostResponse::class => false,
            \Silverstripe\Search\Client\Model\QuerySuggestionRequest::class => false,
            \Silverstripe\Search\Client\Model\QuerySuggestionResponse::class => false,
            \Silverstripe\Search\Client\Model\QuerySuggestionResponseValue::class => false,
            \Silverstripe\Search\Client\Model\Range::class => false,
            \Silverstripe\Search\Client\Model\RequestFacetRange::class => false,
            \Silverstripe\Search\Client\Model\RequestFacetRangeObject::class => false,
            \Silverstripe\Search\Client\Model\RequestFacetValue::class => false,
            \Silverstripe\Search\Client\Model\ResponseAcknowledged::class => false,
            \Silverstripe\Search\Client\Model\ResponseConfirm::class => false,
            \Silverstripe\Search\Client\Model\ResponseFacetRange::class => false,
            \Silverstripe\Search\Client\Model\ResponseFacetValue::class => false,
            \Silverstripe\Search\Client\Model\ResponseSuccess::class => false,
            \Silverstripe\Search\Client\Model\Schema::class => false,
            \Silverstripe\Search\Client\Model\SchemaGetResponse::class => false,
            \Silverstripe\Search\Client\Model\SearchRequest::class => false,
            \Silverstripe\Search\Client\Model\SearchRequestBoost::class => false,
            \Silverstripe\Search\Client\Model\SearchRequestPagination::class => false,
            \Silverstripe\Search\Client\Model\SearchRequestResultField::class => false,
            \Silverstripe\Search\Client\Model\SearchRequestResultFieldRaw::class => false,
            \Silverstripe\Search\Client\Model\SearchRequestResultFieldSnippet::class => false,
            \Silverstripe\Search\Client\Model\SearchRequestSearchFieldsWeight::class => false,
            \Silverstripe\Search\Client\Model\SearchResponse::class => false,
            \Silverstripe\Search\Client\Model\SearchResponseEngine::class => false,
            \Silverstripe\Search\Client\Model\SearchResponseMeta::class => false,
            \Silverstripe\Search\Client\Model\SettingsRequest::class => false,
            \Silverstripe\Search\Client\Model\SettingsResponse::class => false,
            \Silverstripe\Search\Client\Model\SpellingSuggestionRequest::class => false,
            \Silverstripe\Search\Client\Model\SpellingSuggestionResponse::class => false,
            \Silverstripe\Search\Client\Model\SynonymRule::class => false,
            \Silverstripe\Search\Client\Model\SynonymRuleRequest::class => false,
            \Silverstripe\Search\Client\Model\Tags::class => false,
            \Silverstripe\Search\Client\Model\ValidationError::class => false,
            \Silverstripe\Search\Client\Model\CommonModelsCurationGetResponseGetResponse::class => false,
            \Silverstripe\Search\Client\Model\CommonModelsCurationPatchRequestPatchRequest::class => false,
            \Silverstripe\Search\Client\Model\CommonModelsCurationPostRequestPostRequest::class => false,
            \Silverstripe\Search\Client\Model\CommonModelsCurationDocumentGetResponseGetResponse::class => false,
            \Silverstripe\Search\Client\Model\CommonModelsCurationDocumentPatchRequestPatchRequest::class => false,
            \Silverstripe\Search\Client\Model\CommonModelsCurationDocumentPostRequestPostRequest::class => false,
            \Silverstripe\Search\Client\Model\CommonModelsCurationQueryGetResponseGetResponse::class => false,
            \Silverstripe\Search\Client\Model\CommonModelsCurationQueryPostRequestPostRequest::class => false,
            \Jane\Component\JsonSchemaRuntime\Reference::class => false,
        ];
    }
}