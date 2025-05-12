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
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \Silverstripe\Search\Client\Model\SearchRequest();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('query', $data)) {
            $object->setQuery($data['query']);
        }
        if (\array_key_exists('sort', $data)) {
            $value = $data['sort'];
            if (is_null($data['sort'])) {
                $value = $data['sort'];
            }
            $object->setSort($value);
        }
        if (\array_key_exists('page', $data)) {
            $value_1 = $data['page'];
            if (is_array($data['page'])) {
                $value_1 = $this->denormalizer->denormalize($data['page'], \Silverstripe\Search\Client\Model\PaginationNoTotals::class, 'json', $context);
            } elseif (is_null($data['page'])) {
                $value_1 = $data['page'];
            }
            $object->setPage($value_1);
        }
        if (\array_key_exists('search_fields', $data)) {
            $value_2 = $data['search_fields'];
            if (is_null($data['search_fields'])) {
                $value_2 = $data['search_fields'];
            }
            $object->setSearchFields($value_2);
        }
        if (\array_key_exists('result_fields', $data)) {
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
        if (\array_key_exists('facets', $data)) {
            $value_5 = $data['facets'];
            if (is_array($data['facets']) && $this->isOnlyNumericKeys($data['facets'])) {
                $values_1 = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
                foreach ($data['facets'] as $key_1 => $value_6) {
                    $values_2 = [];
                    foreach ($value_6 as $value_7) {
                        $values_2[] = $value_7;
                    }
                    $values_1[$key_1] = $values_2;
                }
                $value_5 = $values_1;
            } elseif (is_null($data['facets'])) {
                $value_5 = $data['facets'];
            }
            $object->setFacets($value_5);
        }
        if (\array_key_exists('filters', $data)) {
            $value_8 = $data['filters'];
            if (is_array($data['filters'])) {
                $value_8 = $this->denormalizer->denormalize($data['filters'], \Silverstripe\Search\Client\Model\Filters::class, 'json', $context);
            } elseif (is_null($data['filters'])) {
                $value_8 = $data['filters'];
            }
            $object->setFilters($value_8);
        }
        if (\array_key_exists('analytics', $data)) {
            $value_9 = $data['analytics'];
            if (is_array($data['analytics']) and isset($data['analytics']['tags'])) {
                $value_9 = $this->denormalizer->denormalize($data['analytics'], \Silverstripe\Search\Client\Model\Tags::class, 'json', $context);
            } elseif (is_null($data['analytics'])) {
                $value_9 = $data['analytics'];
            }
            $object->setAnalytics($value_9);
        }
        return $object;
    }
    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        $dataArray['query'] = $data->getQuery();
        if ($data->isInitialized('sort') && null !== $data->getSort()) {
            $value = $data->getSort();
            if (is_null($data->getSort())) {
                $value = $data->getSort();
            }
            $dataArray['sort'] = $value;
        }
        if ($data->isInitialized('page') && null !== $data->getPage()) {
            $value_1 = $data->getPage();
            if (is_object($data->getPage())) {
                $value_1 = $data->getPage() == null ? null : new \ArrayObject($this->normalizer->normalize($data->getPage(), 'json', $context), \ArrayObject::ARRAY_AS_PROPS);
            } elseif (is_null($data->getPage())) {
                $value_1 = $data->getPage();
            }
            $dataArray['page'] = $value_1;
        }
        if ($data->isInitialized('searchFields') && null !== $data->getSearchFields()) {
            $value_2 = $data->getSearchFields();
            if (is_null($data->getSearchFields())) {
                $value_2 = $data->getSearchFields();
            }
            $dataArray['search_fields'] = $value_2;
        }
        if ($data->isInitialized('resultFields') && null !== $data->getResultFields()) {
            $value_3 = $data->getResultFields();
            if (is_object($data->getResultFields())) {
                $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
                foreach ($data->getResultFields() as $key => $value_4) {
                    $values[$key] = $value_4 == null ? null : new \ArrayObject($this->normalizer->normalize($value_4, 'json', $context), \ArrayObject::ARRAY_AS_PROPS);
                }
                $value_3 = $values;
            } elseif (is_null($data->getResultFields())) {
                $value_3 = $data->getResultFields();
            }
            $dataArray['result_fields'] = $value_3;
        }
        if ($data->isInitialized('facets') && null !== $data->getFacets()) {
            $value_5 = $data->getFacets();
            if (is_object($data->getFacets())) {
                $values_1 = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
                foreach ($data->getFacets() as $key_1 => $value_6) {
                    $values_2 = [];
                    foreach ($value_6 as $value_7) {
                        $values_2[] = $value_7;
                    }
                    $values_1[$key_1] = $values_2;
                }
                $value_5 = $values_1;
            } elseif (is_null($data->getFacets())) {
                $value_5 = $data->getFacets();
            }
            $dataArray['facets'] = $value_5;
        }
        if ($data->isInitialized('filters') && null !== $data->getFilters()) {
            $value_8 = $data->getFilters();
            if (is_object($data->getFilters())) {
                $value_8 = $data->getFilters() == null ? null : new \ArrayObject($this->normalizer->normalize($data->getFilters(), 'json', $context), \ArrayObject::ARRAY_AS_PROPS);
            } elseif (is_null($data->getFilters())) {
                $value_8 = $data->getFilters();
            }
            $dataArray['filters'] = $value_8;
        }
        if ($data->isInitialized('analytics') && null !== $data->getAnalytics()) {
            $value_9 = $data->getAnalytics();
            if (is_object($data->getAnalytics())) {
                $value_9 = $data->getAnalytics() == null ? null : new \ArrayObject($this->normalizer->normalize($data->getAnalytics(), 'json', $context), \ArrayObject::ARRAY_AS_PROPS);
            } elseif (is_null($data->getAnalytics())) {
                $value_9 = $data->getAnalytics();
            }
            $dataArray['analytics'] = $value_9;
        }
        return $dataArray;
    }
    public function getSupportedTypes(?string $format = null): array
    {
        return [\Silverstripe\Search\Client\Model\SearchRequest::class => false];
    }
}