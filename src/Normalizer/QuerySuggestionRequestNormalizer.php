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
class QuerySuggestionRequestNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Silverstripe\Search\Client\Model\QuerySuggestionRequest::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Silverstripe\Search\Client\Model\QuerySuggestionRequest::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \Silverstripe\Search\Client\Model\QuerySuggestionRequest();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('query', $data)) {
            $object->setQuery($data['query']);
            unset($data['query']);
        }
        if (\array_key_exists('size', $data)) {
            $object->setSize($data['size']);
            unset($data['size']);
        }
        if (\array_key_exists('fields', $data)) {
            $object->setFields($data['fields']);
            unset($data['fields']);
        }
        foreach ($data as $key => $value) {
            if (preg_match('/.*/', (string) $key)) {
                $object[$key] = $value;
            }
        }
        return $object;
    }
    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        $dataArray['query'] = $data->getQuery();
        if ($data->isInitialized('size') && null !== $data->getSize()) {
            $dataArray['size'] = $data->getSize();
        }
        if ($data->isInitialized('fields') && null !== $data->getFields()) {
            $dataArray['fields'] = $data->getFields();
        }
        foreach ($data as $key => $value) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value;
            }
        }
        return $dataArray;
    }
    public function getSupportedTypes(?string $format = null): array
    {
        return [\Silverstripe\Search\Client\Model\QuerySuggestionRequest::class => false];
    }
}