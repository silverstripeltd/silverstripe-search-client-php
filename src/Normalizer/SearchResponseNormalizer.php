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
class SearchResponseNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Silverstripe\Search\Client\Model\SearchResponse::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Silverstripe\Search\Client\Model\SearchResponse::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Silverstripe\Search\Client\Model\SearchResponse();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('meta', $data)) {
            $object->setMeta($this->denormalizer->denormalize($data['meta'], \Silverstripe\Search\Client\Model\SearchResponseMeta::class, 'json', $context));
        }
        if (\array_key_exists('results', $data)) {
            $values = [];
            foreach ($data['results'] as $value) {
                $values_1 = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
                foreach ($value as $key => $value_1) {
                    $value_2 = $value_1;
                    if (is_array($value_1)) {
                        $value_2 = $this->denormalizer->denormalize($value_1, \Silverstripe\Search\Client\Model\DocumentResponseMeta::class, 'json', $context);
                    } elseif (is_array($value_1)) {
                        $value_2 = $this->denormalizer->denormalize($value_1, \Silverstripe\Search\Client\Model\DocumentField::class, 'json', $context);
                    }
                    $values_1[$key] = $value_2;
                }
                $values[] = $values_1;
            }
            $object->setResults($values);
        }
        if (\array_key_exists('facets', $data) && $data['facets'] !== null) {
            $object->setFacets($data['facets']);
        }
        elseif (\array_key_exists('facets', $data) && $data['facets'] === null) {
            $object->setFacets(null);
        }
        return $object;
    }
    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        $dataArray['meta'] = $this->normalizer->normalize($data->getMeta(), 'json', $context);
        $values = [];
        foreach ($data->getResults() as $value) {
            $values_1 = [];
            foreach ($value as $key => $value_1) {
                $value_2 = $value_1;
                if (is_object($value_1)) {
                    $value_2 = $this->normalizer->normalize($value_1, 'json', $context);
                } elseif (is_object($value_1)) {
                    $value_2 = $this->normalizer->normalize($value_1, 'json', $context);
                }
                $values_1[$key] = $value_2;
            }
            $values[] = $values_1;
        }
        $dataArray['results'] = $values;
        if ($data->isInitialized('facets')) {
            $dataArray['facets'] = $data->getFacets();
        }
        return $dataArray;
    }
    public function getSupportedTypes(?string $format = null): array
    {
        return [\Silverstripe\Search\Client\Model\SearchResponse::class => false];
    }
}