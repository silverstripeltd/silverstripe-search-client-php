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
class SearchResponseMetaNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Silverstripe\Search\Client\Model\SearchResponseMeta::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Silverstripe\Search\Client\Model\SearchResponseMeta::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Silverstripe\Search\Client\Model\SearchResponseMeta();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('warnings', $data) && $data['warnings'] !== null) {
            $object->setWarnings($data['warnings']);
        }
        elseif (\array_key_exists('warnings', $data) && $data['warnings'] === null) {
            $object->setWarnings(null);
        }
        if (\array_key_exists('precision', $data) && $data['precision'] !== null) {
            $object->setPrecision($data['precision']);
        }
        elseif (\array_key_exists('precision', $data) && $data['precision'] === null) {
            $object->setPrecision(null);
        }
        if (\array_key_exists('engine', $data) && $data['engine'] !== null) {
            $value = $data['engine'];
            if (is_array($data['engine'])) {
                $value = $this->denormalizer->denormalize($data['engine'], \Silverstripe\Search\Client\Model\SearchResponseEngine::class, 'json', $context);
            } elseif (is_null($data['engine'])) {
                $value = $data['engine'];
            }
            $object->setEngine($value);
        }
        elseif (\array_key_exists('engine', $data) && $data['engine'] === null) {
            $object->setEngine(null);
        }
        if (\array_key_exists('request_id', $data) && $data['request_id'] !== null) {
            $object->setRequestId($data['request_id']);
        }
        elseif (\array_key_exists('request_id', $data) && $data['request_id'] === null) {
            $object->setRequestId(null);
        }
        if (\array_key_exists('page', $data)) {
            $object->setPage($this->denormalizer->denormalize($data['page'], \Silverstripe\Search\Client\Model\PaginationResponse::class, 'json', $context));
        }
        return $object;
    }
    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        if ($data->isInitialized('warnings')) {
            $dataArray['warnings'] = $data->getWarnings();
        }
        if ($data->isInitialized('precision')) {
            $dataArray['precision'] = $data->getPrecision();
        }
        if ($data->isInitialized('engine')) {
            $value = $data->getEngine();
            if (is_object($data->getEngine())) {
                $value = $this->normalizer->normalize($data->getEngine(), 'json', $context);
            } elseif (is_null($data->getEngine())) {
                $value = $data->getEngine();
            }
            $dataArray['engine'] = $value;
        }
        if ($data->isInitialized('requestId')) {
            $dataArray['request_id'] = $data->getRequestId();
        }
        $dataArray['page'] = $this->normalizer->normalize($data->getPage(), 'json', $context);
        return $dataArray;
    }
    public function getSupportedTypes(?string $format = null): array
    {
        return [\Silverstripe\Search\Client\Model\SearchResponseMeta::class => false];
    }
}