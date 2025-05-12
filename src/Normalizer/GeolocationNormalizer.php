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
class GeolocationNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Silverstripe\Search\Client\Model\Geolocation::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Silverstripe\Search\Client\Model\Geolocation::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \Silverstripe\Search\Client\Model\Geolocation();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('center', $data)) {
            $value = $data['center'];
            if (is_array($data['center']) and isset($data['center']['latitude']) and isset($data['center']['longitude'])) {
                $value = $this->denormalizer->denormalize($data['center'], \Silverstripe\Search\Client\Model\Coordinate::class, 'json', $context);
            } elseif (is_array($data['center']) && $this->isOnlyNumericKeys($data['center'])) {
                $values = [];
                foreach ($data['center'] as $value_1) {
                    $values[] = $value_1;
                }
                $value = $values;
            } elseif (is_string($data['center'])) {
                $value = $data['center'];
            }
            $object->setCenter($value);
            unset($data['center']);
        }
        if (\array_key_exists('order', $data)) {
            $object->setOrder($data['order']);
            unset($data['order']);
        }
        foreach ($data as $key => $value_2) {
            if (preg_match('/.*/', (string) $key)) {
                $object[$key] = $value_2;
            }
        }
        return $object;
    }
    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        $dataArray = [];
        $value = $data->getCenter();
        if (is_object($data->getCenter())) {
            $value = $data->getCenter() == null ? null : new \ArrayObject($this->normalizer->normalize($data->getCenter(), 'json', $context), \ArrayObject::ARRAY_AS_PROPS);
        } elseif (is_array($data->getCenter())) {
            $values = [];
            foreach ($data->getCenter() as $value_1) {
                $values[] = $value_1;
            }
            $value = $values;
        } elseif (is_string($data->getCenter())) {
            $value = $data->getCenter();
        }
        $dataArray['center'] = $value;
        $dataArray['order'] = $data->getOrder();
        foreach ($data as $key => $value_2) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value_2;
            }
        }
        return $dataArray;
    }
    public function getSupportedTypes(?string $format = null): array
    {
        return [\Silverstripe\Search\Client\Model\Geolocation::class => false];
    }
}