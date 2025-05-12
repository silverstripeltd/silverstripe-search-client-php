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
class SearchRequestResultFieldNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Silverstripe\Search\Client\Model\SearchRequestResultField::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Silverstripe\Search\Client\Model\SearchRequestResultField::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \Silverstripe\Search\Client\Model\SearchRequestResultField();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('raw', $data)) {
            $value = $data['raw'];
            if (is_array($data['raw'])) {
                $value = $this->denormalizer->denormalize($data['raw'], \Silverstripe\Search\Client\Model\SearchRequestResultFieldRaw::class, 'json', $context);
            } elseif (is_null($data['raw'])) {
                $value = $data['raw'];
            }
            $object->setRaw($value);
            unset($data['raw']);
        }
        if (\array_key_exists('snippet', $data)) {
            $value_1 = $data['snippet'];
            if (is_array($data['snippet'])) {
                $value_1 = $this->denormalizer->denormalize($data['snippet'], \Silverstripe\Search\Client\Model\SearchRequestResultFieldSnippet::class, 'json', $context);
            } elseif (is_null($data['snippet'])) {
                $value_1 = $data['snippet'];
            }
            $object->setSnippet($value_1);
            unset($data['snippet']);
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
        if ($data->isInitialized('raw') && null !== $data->getRaw()) {
            $value = $data->getRaw();
            if (is_object($data->getRaw())) {
                $value = $this->normalizer->normalize($data->getRaw(), 'json', $context);
            } elseif (is_null($data->getRaw())) {
                $value = $data->getRaw();
            }
            $dataArray['raw'] = $value;
        }
        if ($data->isInitialized('snippet') && null !== $data->getSnippet()) {
            $value_1 = $data->getSnippet();
            if (is_object($data->getSnippet())) {
                $value_1 = $this->normalizer->normalize($data->getSnippet(), 'json', $context);
            } elseif (is_null($data->getSnippet())) {
                $value_1 = $data->getSnippet();
            }
            $dataArray['snippet'] = $value_1;
        }
        foreach ($data as $key => $value_2) {
            if (preg_match('/.*/', (string) $key)) {
                $dataArray[$key] = $value_2;
            }
        }
        return $dataArray;
    }
    public function getSupportedTypes(?string $format = null): array
    {
        return [\Silverstripe\Search\Client\Model\SearchRequestResultField::class => false];
    }
}