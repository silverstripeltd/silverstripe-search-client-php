<?php

namespace Silverstripe\Search\Client\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Silverstripe\Search\Client\Runtime\Normalizer\CheckArray;
use Silverstripe\Search\Client\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class SearchRequestNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Silverstripe\Search\Client\Model\SearchRequest::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Silverstripe\Search\Client\Model\SearchRequest::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Silverstripe\Search\Client\Model\SearchRequest();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('record_analytics', $data) && \is_int($data['record_analytics'])) {
            $data['record_analytics'] = (bool) $data['record_analytics'];
        }
        if (\array_key_exists('query', $data)) {
            $object->setQuery($data['query']);
        }
        if (\array_key_exists('sort', $data) && $data['sort'] !== null) {
            $value = $data['sort'];
            if (is_null($data['sort'])) {
                $value = $data['sort'];
            }
            $object->setSort($value);
        }
        elseif (\array_key_exists('sort', $data) && $data['sort'] === null) {
            $object->setSort(null);
        }
        if (\array_key_exists('page', $data) && $data['page'] !== null) {
            $value_1 = $data['page'];
            if (is_array($data['page'])) {
                $value_1 = $this->denormalizer->denormalize($data['page'], \Silverstripe\Search\Client\Model\SearchRequestPagination::class, 'json', $context);
            } elseif (is_null($data['page'])) {
                $value_1 = $data['page'];
            }
            $object->setPage($value_1);
        }
        elseif (\array_key_exists('page', $data) && $data['page'] === null) {
            $object->setPage(null);
        }
        if (\array_key_exists('search_fields', $data) && $data['search_fields'] !== null) {
            $value_2 = $data['search_fields'];
            if (is_null($data['search_fields'])) {
                $value_2 = $data['search_fields'];
            }
            $object->setSearchFields($value_2);
        }
        elseif (\array_key_exists('search_fields', $data) && $data['search_fields'] === null) {
            $object->setSearchFields(null);
        }
        if (\array_key_exists('result_fields', $data) && $data['result_fields'] !== null) {
            $value_3 = $data['result_fields'];
            if (is_array($data['result_fields']) && $this->isOnlyNumericKeys($data['result_fields'])) {
                $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
                foreach ($data['result_fields'] as $key => $value_4) {
                    $values[$key] = $this->denormalizer->denormalize($value_4, \Silverstripe\Search\Client\Model\SearchRequestResultField::class, 'json', $context);
                }
                $value_3 = $values;
            } elseif (is_null($data['result_fields'])) {
                $value_3 = $data['result_fields'];
            }
            $object->setResultFields($value_3);
        }
        elseif (\array_key_exists('result_fields', $data) && $data['result_fields'] === null) {
            $object->setResultFields(null);
        }
        if (\array_key_exists('facets', $data) && $data['facets'] !== null) {
            $value_5 = $data['facets'];
            if (is_array($data['facets']) && $this->isOnlyNumericKeys($data['facets'])) {
                $values_1 = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
                foreach ($data['facets'] as $key_1 => $value_6) {
                    $values_2 = [];
                    foreach ($value_6 as $value_7) {
                        $value_8 = $value_7;
                        if (is_array($value_7) and (isset($value_7['type']) and ($value_7['type'] == 'value' or $value_7['type'] == 'range'))) {
                            $value_8 = $this->denormalizer->denormalize($value_7, \Silverstripe\Search\Client\Model\RequestFacetValue::class, 'json', $context);
                        } elseif (is_array($value_7) and (isset($value_7['type']) and ($value_7['type'] == 'value' or $value_7['type'] == 'range')) and isset($value_7['ranges'])) {
                            $value_8 = $this->denormalizer->denormalize($value_7, \Silverstripe\Search\Client\Model\RequestFacetRange::class, 'json', $context);
                        }
                        $values_2[] = $value_8;
                    }
                    $values_1[$key_1] = $values_2;
                }
                $value_5 = $values_1;
            } elseif (is_null($data['facets'])) {
                $value_5 = $data['facets'];
            }
            $object->setFacets($value_5);
        }
        elseif (\array_key_exists('facets', $data) && $data['facets'] === null) {
            $object->setFacets(null);
        }
        if (\array_key_exists('filters', $data) && $data['filters'] !== null) {
            $value_9 = $data['filters'];
            if (is_array($data['filters'])) {
                $value_9 = $this->denormalizer->denormalize($data['filters'], \Silverstripe\Search\Client\Model\Filters::class, 'json', $context);
            } elseif (is_null($data['filters'])) {
                $value_9 = $data['filters'];
            }
            $object->setFilters($value_9);
        }
        elseif (\array_key_exists('filters', $data) && $data['filters'] === null) {
            $object->setFilters(null);
        }
        if (\array_key_exists('boosts', $data) && $data['boosts'] !== null) {
            $object->setBoosts($data['boosts']);
        }
        elseif (\array_key_exists('boosts', $data) && $data['boosts'] === null) {
            $object->setBoosts(null);
        }
        if (\array_key_exists('analytics', $data) && $data['analytics'] !== null) {
            $value_10 = $data['analytics'];
            if (is_array($data['analytics']) and isset($data['analytics']['tags'])) {
                $value_10 = $this->denormalizer->denormalize($data['analytics'], \Silverstripe\Search\Client\Model\Tags::class, 'json', $context);
            } elseif (is_null($data['analytics'])) {
                $value_10 = $data['analytics'];
            }
            $object->setAnalytics($value_10);
        }
        elseif (\array_key_exists('analytics', $data) && $data['analytics'] === null) {
            $object->setAnalytics(null);
        }
        if (\array_key_exists('record_analytics', $data)) {
            $object->setRecordAnalytics($data['record_analytics']);
        }
        return $object;
    }
    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        $dataArray['query'] = $data->getQuery();
        if ($data->isInitialized('sort')) {
            $value = $data->getSort();
            if (is_null($data->getSort())) {
                $value = $data->getSort();
            }
            $dataArray['sort'] = $value;
        }
        if ($data->isInitialized('page')) {
            $value_1 = $data->getPage();
            if (is_object($data->getPage())) {
                $value_1 = $this->normalizer->normalize($data->getPage(), 'json', $context);
            } elseif (is_null($data->getPage())) {
                $value_1 = $data->getPage();
            }
            $dataArray['page'] = $value_1;
        }
        if ($data->isInitialized('searchFields')) {
            $value_2 = $data->getSearchFields();
            if (is_null($data->getSearchFields())) {
                $value_2 = $data->getSearchFields();
            }
            $dataArray['search_fields'] = $value_2;
        }
        if ($data->isInitialized('resultFields')) {
            $value_3 = $data->getResultFields();
            if (is_object($data->getResultFields())) {
                $values = [];
                foreach ($data->getResultFields() as $key => $value_4) {
                    $values[$key] = $this->normalizer->normalize($value_4, 'json', $context);
                }
                $value_3 = $values;
            } elseif (is_null($data->getResultFields())) {
                $value_3 = $data->getResultFields();
            }
            $dataArray['result_fields'] = $value_3;
        }
        if ($data->isInitialized('facets')) {
            $value_5 = $data->getFacets();
            if (is_object($data->getFacets())) {
                $values_1 = [];
                foreach ($data->getFacets() as $key_1 => $value_6) {
                    $values_2 = [];
                    foreach ($value_6 as $value_7) {
                        $value_8 = $value_7;
                        if (is_object($value_7)) {
                            $value_8 = $this->normalizer->normalize($value_7, 'json', $context);
                        } elseif (is_object($value_7)) {
                            $value_8 = $this->normalizer->normalize($value_7, 'json', $context);
                        }
                        $values_2[] = $value_8;
                    }
                    $values_1[$key_1] = $values_2;
                }
                $value_5 = $values_1;
            } elseif (is_null($data->getFacets())) {
                $value_5 = $data->getFacets();
            }
            $dataArray['facets'] = $value_5;
        }
        if ($data->isInitialized('filters')) {
            $value_9 = $data->getFilters();
            if (is_object($data->getFilters())) {
                $value_9 = $this->normalizer->normalize($data->getFilters(), 'json', $context);
            } elseif (is_null($data->getFilters())) {
                $value_9 = $data->getFilters();
            }
            $dataArray['filters'] = $value_9;
        }
        if ($data->isInitialized('boosts')) {
            $dataArray['boosts'] = $data->getBoosts();
        }
        if ($data->isInitialized('analytics')) {
            $value_10 = $data->getAnalytics();
            if (is_object($data->getAnalytics())) {
                $value_10 = $this->normalizer->normalize($data->getAnalytics(), 'json', $context);
            } elseif (is_null($data->getAnalytics())) {
                $value_10 = $data->getAnalytics();
            }
            $dataArray['analytics'] = $value_10;
        }
        if ($data->isInitialized('recordAnalytics') && null !== $data->getRecordAnalytics()) {
            $dataArray['record_analytics'] = $data->getRecordAnalytics();
        }
        return $dataArray;
    }
    public function getSupportedTypes(?string $format = null): array
    {
        return [\Silverstripe\Search\Client\Model\SearchRequest::class => false];
    }
}