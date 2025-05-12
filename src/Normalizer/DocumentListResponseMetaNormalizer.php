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
class DocumentListResponseMetaNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === \Silverstripe\Search\Client\Model\DocumentListResponseMeta::class;
    }
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_object($data) && get_class($data) === \Silverstripe\Search\Client\Model\DocumentListResponseMeta::class;
    }
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \Silverstripe\Search\Client\Model\DocumentListResponseMeta();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('alerts', $data)) {
            $object->setAlerts($data['alerts']);
            unset($data['alerts']);
        }
        if (\array_key_exists('page', $data)) {
            $object->setPage($this->denormalizer->denormalize($data['page'], \Silverstripe\Search\Client\Model\PaginationWithTotals::class, 'json', $context));
            unset($data['page']);
        }
        if (\array_key_exists('request_id', $data)) {
            $object->setRequestId($data['request_id']);
            unset($data['request_id']);
        }
        if (\array_key_exists('warnings', $data)) {
            $object->setWarnings($data['warnings']);
            unset($data['warnings']);
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
        if ($data->isInitialized('alerts') && null !== $data->getAlerts()) {
            $dataArray['alerts'] = $data->getAlerts();
        }
        $dataArray['page'] = $this->normalizer->normalize($data->getPage(), 'json', $context);
        if ($data->isInitialized('requestId') && null !== $data->getRequestId()) {
            $dataArray['request_id'] = $data->getRequestId();
        }
        if ($data->isInitialized('warnings') && null !== $data->getWarnings()) {
            $dataArray['warnings'] = $data->getWarnings();
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
        return [\Silverstripe\Search\Client\Model\DocumentListResponseMeta::class => false];
    }
}