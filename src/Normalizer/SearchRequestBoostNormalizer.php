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
class SearchRequestBoostNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Silverstripe\Search\Client\Model\SearchRequestBoost::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Silverstripe\Search\Client\Model\SearchRequestBoost::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $object = new \Silverstripe\Search\Client\Model\SearchRequestBoost();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (isset($data['$ref']) && !isset($data['type']) && !isset($data['properties']) && !isset($data['allOf'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        if (\array_key_exists('factor', $data) && \is_int($data['factor'])) {
            $data['factor'] = (double) $data['factor'];
        }
        if (\array_key_exists('type', $data)) {
            $object->setType($data['type']);
        }
        if (\array_key_exists('value', $data) && $data['value'] !== null) {
            $object->setValue($data['value']);
        }
        elseif (\array_key_exists('value', $data) && $data['value'] === null) {
            $object->setValue(null);
        }
        if (\array_key_exists('factor', $data)) {
            $object->setFactor($data['factor']);
        }
        if (\array_key_exists('center', $data) && $data['center'] !== null) {
            $object->setCenter($data['center']);
        }
        elseif (\array_key_exists('center', $data) && $data['center'] === null) {
            $object->setCenter(null);
        }
        if (\array_key_exists('function', $data) && $data['function'] !== null) {
            $object->setFunction($data['function']);
        }
        elseif (\array_key_exists('function', $data) && $data['function'] === null) {
            $object->setFunction(null);
        }
        if (\array_key_exists('operation', $data) && $data['operation'] !== null) {
            $value = $data['operation'];
            if (is_string($data['operation'])) {
                $value = $data['operation'];
            } elseif (is_null($data['operation'])) {
                $value = $data['operation'];
            }
            $object->setOperation($value);
        }
        elseif (\array_key_exists('operation', $data) && $data['operation'] === null) {
            $object->setOperation(null);
        }
        return $object;
    }
    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        $dataArray['type'] = $data->getType();
        if ($data->isInitialized('value')) {
            $dataArray['value'] = $data->getValue();
        }
        if ($data->isInitialized('factor') && null !== $data->getFactor()) {
            $dataArray['factor'] = $data->getFactor();
        }
        if ($data->isInitialized('center')) {
            $dataArray['center'] = $data->getCenter();
        }
        if ($data->isInitialized('function')) {
            $dataArray['function'] = $data->getFunction();
        }
        if ($data->isInitialized('operation')) {
            $value = $data->getOperation();
            if (is_string($data->getOperation())) {
                $value = $data->getOperation();
            } elseif (is_null($data->getOperation())) {
                $value = $data->getOperation();
            }
            $dataArray['operation'] = $value;
        }
        return $dataArray;
    }
    public function getSupportedTypes(?string $format = null): array
    {
        return [\Silverstripe\Search\Client\Model\SearchRequestBoost::class => false];
    }
}