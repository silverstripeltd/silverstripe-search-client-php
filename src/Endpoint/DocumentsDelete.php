<?php

namespace Silverstripe\Search\Client\Endpoint;

class DocumentsDelete extends \Silverstripe\Search\Client\Runtime\Client\BaseEndpoint implements \Silverstripe\Search\Client\Runtime\Client\Endpoint
{
    protected $engine_name;
    /**
     * Delete documents by `id`.
     *
     * @param string $engineName 
     * @param array[] $requestBody 
     */
    public function __construct(string $engineName, array $requestBody)
    {
        $this->engine_name = $engineName;
        $this->body = $requestBody;
    }
    use \Silverstripe\Search\Client\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'DELETE';
    }
    public function getUri(): string
    {
        return str_replace(['{engine_name}'], [$this->engine_name], '/{engine_name}/documents');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if (is_array($this->body)) {
            return [['Content-Type' => ['application/json']], json_encode($this->body)];
        }
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    /**
     * {@inheritdoc}
     *
     * @throws \Silverstripe\Search\Client\Exception\DocumentsDeleteNotFoundException
     * @throws \Silverstripe\Search\Client\Exception\DocumentsDeleteUnprocessableEntityException
     *
     * @return null|\Silverstripe\Search\Client\Model\DocumentsDeleteResponse[]
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Silverstripe\Search\Client\Model\DocumentsDeleteResponse[]', 'json');
        }
        if (404 === $status) {
            throw new \Silverstripe\Search\Client\Exception\DocumentsDeleteNotFoundException($response);
        }
        if (is_null($contentType) === false && (422 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \Silverstripe\Search\Client\Exception\DocumentsDeleteUnprocessableEntityException($serializer->deserialize($body, 'Silverstripe\Search\Client\Model\HTTPValidationError', 'json'), $response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['HTTPBearer'];
    }
}