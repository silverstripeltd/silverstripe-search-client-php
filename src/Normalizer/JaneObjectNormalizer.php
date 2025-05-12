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
        
        \Silverstripe\Search\Client\Model\Coordinate::class => \Silverstripe\Search\Client\Normalizer\CoordinateNormalizer::class,
        
        \Silverstripe\Search\Client\Model\DocumentField::class => \Silverstripe\Search\Client\Normalizer\DocumentFieldNormalizer::class,
        
        \Silverstripe\Search\Client\Model\DocumentListRequest::class => \Silverstripe\Search\Client\Normalizer\DocumentListRequestNormalizer::class,
        
        \Silverstripe\Search\Client\Model\DocumentListResponse::class => \Silverstripe\Search\Client\Normalizer\DocumentListResponseNormalizer::class,
        
        \Silverstripe\Search\Client\Model\DocumentListResponseMeta::class => \Silverstripe\Search\Client\Normalizer\DocumentListResponseMetaNormalizer::class,
        
        \Silverstripe\Search\Client\Model\DocumentPostPatchResponse::class => \Silverstripe\Search\Client\Normalizer\DocumentPostPatchResponseNormalizer::class,
        
        \Silverstripe\Search\Client\Model\DocumentResponseMeta::class => \Silverstripe\Search\Client\Normalizer\DocumentResponseMetaNormalizer::class,
        
        \Silverstripe\Search\Client\Model\DocumentsDeleteResponse::class => \Silverstripe\Search\Client\Normalizer\DocumentsDeleteResponseNormalizer::class,
        
        \Silverstripe\Search\Client\Model\Engine::class => \Silverstripe\Search\Client\Normalizer\EngineNormalizer::class,
        
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
        
        \Silverstripe\Search\Client\Model\PaginationNoTotals::class => \Silverstripe\Search\Client\Normalizer\PaginationNoTotalsNormalizer::class,
        
        \Silverstripe\Search\Client\Model\PaginationWithTotals::class => \Silverstripe\Search\Client\Normalizer\PaginationWithTotalsNormalizer::class,
        
        \Silverstripe\Search\Client\Model\QuerySuggestionRequest::class => \Silverstripe\Search\Client\Normalizer\QuerySuggestionRequestNormalizer::class,
        
        \Silverstripe\Search\Client\Model\QuerySuggestionResponse::class => \Silverstripe\Search\Client\Normalizer\QuerySuggestionResponseNormalizer::class,
        
        \Silverstripe\Search\Client\Model\QuerySuggestionResponseValue::class => \Silverstripe\Search\Client\Normalizer\QuerySuggestionResponseValueNormalizer::class,
        
        \Silverstripe\Search\Client\Model\Range::class => \Silverstripe\Search\Client\Normalizer\RangeNormalizer::class,
        
        \Silverstripe\Search\Client\Model\RequestFacetRange::class => \Silverstripe\Search\Client\Normalizer\RequestFacetRangeNormalizer::class,
        
        \Silverstripe\Search\Client\Model\RequestFacetRangeObject::class => \Silverstripe\Search\Client\Normalizer\RequestFacetRangeObjectNormalizer::class,
        
        \Silverstripe\Search\Client\Model\RequestFacetValue::class => \Silverstripe\Search\Client\Normalizer\RequestFacetValueNormalizer::class,
        
        \Silverstripe\Search\Client\Model\ResponseFacetRange::class => \Silverstripe\Search\Client\Normalizer\ResponseFacetRangeNormalizer::class,
        
        \Silverstripe\Search\Client\Model\ResponseFacetValue::class => \Silverstripe\Search\Client\Normalizer\ResponseFacetValueNormalizer::class,
        
        \Silverstripe\Search\Client\Model\ResponseSuccess::class => \Silverstripe\Search\Client\Normalizer\ResponseSuccessNormalizer::class,
        
        \Silverstripe\Search\Client\Model\SchemaPostResponse::class => \Silverstripe\Search\Client\Normalizer\SchemaPostResponseNormalizer::class,
        
        \Silverstripe\Search\Client\Model\SearchRequest::class => \Silverstripe\Search\Client\Normalizer\SearchRequestNormalizer::class,
        
        \Silverstripe\Search\Client\Model\SearchRequestResultField::class => \Silverstripe\Search\Client\Normalizer\SearchRequestResultFieldNormalizer::class,
        
        \Silverstripe\Search\Client\Model\SearchRequestResultFieldRaw::class => \Silverstripe\Search\Client\Normalizer\SearchRequestResultFieldRawNormalizer::class,
        
        \Silverstripe\Search\Client\Model\SearchRequestResultFieldSnippet::class => \Silverstripe\Search\Client\Normalizer\SearchRequestResultFieldSnippetNormalizer::class,
        
        \Silverstripe\Search\Client\Model\SearchRequestSearchFieldsWeight::class => \Silverstripe\Search\Client\Normalizer\SearchRequestSearchFieldsWeightNormalizer::class,
        
        \Silverstripe\Search\Client\Model\SearchResponse::class => \Silverstripe\Search\Client\Normalizer\SearchResponseNormalizer::class,
        
        \Silverstripe\Search\Client\Model\SearchResponseEngine::class => \Silverstripe\Search\Client\Normalizer\SearchResponseEngineNormalizer::class,
        
        \Silverstripe\Search\Client\Model\SearchResponseMeta::class => \Silverstripe\Search\Client\Normalizer\SearchResponseMetaNormalizer::class,
        
        \Silverstripe\Search\Client\Model\SpellingSuggestionRequest::class => \Silverstripe\Search\Client\Normalizer\SpellingSuggestionRequestNormalizer::class,
        
        \Silverstripe\Search\Client\Model\SpellingSuggestionResponse::class => \Silverstripe\Search\Client\Normalizer\SpellingSuggestionResponseNormalizer::class,
        
        \Silverstripe\Search\Client\Model\SynonymRule::class => \Silverstripe\Search\Client\Normalizer\SynonymRuleNormalizer::class,
        
        \Silverstripe\Search\Client\Model\SynonymRuleRequest::class => \Silverstripe\Search\Client\Normalizer\SynonymRuleRequestNormalizer::class,
        
        \Silverstripe\Search\Client\Model\Tags::class => \Silverstripe\Search\Client\Normalizer\TagsNormalizer::class,
        
        \Silverstripe\Search\Client\Model\ValidationError::class => \Silverstripe\Search\Client\Normalizer\ValidationErrorNormalizer::class,
        
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
            
            \Silverstripe\Search\Client\Model\Coordinate::class => false,
            \Silverstripe\Search\Client\Model\DocumentField::class => false,
            \Silverstripe\Search\Client\Model\DocumentListRequest::class => false,
            \Silverstripe\Search\Client\Model\DocumentListResponse::class => false,
            \Silverstripe\Search\Client\Model\DocumentListResponseMeta::class => false,
            \Silverstripe\Search\Client\Model\DocumentPostPatchResponse::class => false,
            \Silverstripe\Search\Client\Model\DocumentResponseMeta::class => false,
            \Silverstripe\Search\Client\Model\DocumentsDeleteResponse::class => false,
            \Silverstripe\Search\Client\Model\Engine::class => false,
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
            \Silverstripe\Search\Client\Model\PaginationNoTotals::class => false,
            \Silverstripe\Search\Client\Model\PaginationWithTotals::class => false,
            \Silverstripe\Search\Client\Model\QuerySuggestionRequest::class => false,
            \Silverstripe\Search\Client\Model\QuerySuggestionResponse::class => false,
            \Silverstripe\Search\Client\Model\QuerySuggestionResponseValue::class => false,
            \Silverstripe\Search\Client\Model\Range::class => false,
            \Silverstripe\Search\Client\Model\RequestFacetRange::class => false,
            \Silverstripe\Search\Client\Model\RequestFacetRangeObject::class => false,
            \Silverstripe\Search\Client\Model\RequestFacetValue::class => false,
            \Silverstripe\Search\Client\Model\ResponseFacetRange::class => false,
            \Silverstripe\Search\Client\Model\ResponseFacetValue::class => false,
            \Silverstripe\Search\Client\Model\ResponseSuccess::class => false,
            \Silverstripe\Search\Client\Model\SchemaPostResponse::class => false,
            \Silverstripe\Search\Client\Model\SearchRequest::class => false,
            \Silverstripe\Search\Client\Model\SearchRequestResultField::class => false,
            \Silverstripe\Search\Client\Model\SearchRequestResultFieldRaw::class => false,
            \Silverstripe\Search\Client\Model\SearchRequestResultFieldSnippet::class => false,
            \Silverstripe\Search\Client\Model\SearchRequestSearchFieldsWeight::class => false,
            \Silverstripe\Search\Client\Model\SearchResponse::class => false,
            \Silverstripe\Search\Client\Model\SearchResponseEngine::class => false,
            \Silverstripe\Search\Client\Model\SearchResponseMeta::class => false,
            \Silverstripe\Search\Client\Model\SpellingSuggestionRequest::class => false,
            \Silverstripe\Search\Client\Model\SpellingSuggestionResponse::class => false,
            \Silverstripe\Search\Client\Model\SynonymRule::class => false,
            \Silverstripe\Search\Client\Model\SynonymRuleRequest::class => false,
            \Silverstripe\Search\Client\Model\Tags::class => false,
            \Silverstripe\Search\Client\Model\ValidationError::class => false,
            \Jane\Component\JsonSchemaRuntime\Reference::class => false,
        ];
    }
}