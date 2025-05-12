<?php

namespace Silverstripe\Search\Client\Endpoint;

class DocumentsListPost extends \Silverstripe\Search\Client\Runtime\Client\BaseEndpoint implements \Silverstripe\Search\Client\Runtime\Client\Endpoint
{
    protected $engine_name;
    /**
    * **Body:**
    
    `page` (optional)
    * Object to delimit the pagination parameters.
    
    `page.size` (optional)
    * Number of results per page.
    * Must be greater than or equal to 1 and less than or equal to 100.
    * Defaults to 10.
    
    `page.current` (optional)
    * Page number of results to return.
    * Must be greater than or equal to 1 and less than or equal to 100.
    * Defaults to 1.
    *
    * @param string $engineName 
    * @param \Silverstripe\Search\Client\Model\DocumentListRequest $requestBody 
    */
    public function __construct(string $engineName, \Silverstripe\Search\Client\Model\DocumentListRequest $requestBody)
    {
        $this->engine_name = $engineName;
        $this->body = $requestBody;
    }
    use \Silverstripe\Search\Client\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'POST';
    }
    public function getUri(): string
    {
        return str_replace(['{engine_name}'], [$this->engine_name], '/{engine_name}/documents/list');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \Silverstripe\Search\Client\Model\DocumentListRequest) {
            return [['Content-Type' => ['application/json']], $serializer->serialize($this->body, 'json')];
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
     * @throws \Silverstripe\Search\Client\Exception\DocumentsListPostNotFoundException
     * @throws \Silverstripe\Search\Client\Exception\DocumentsListPostUnprocessableEntityException
     *
     * @return null|\Silverstripe\Search\Client\Model\DocumentListResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Silverstripe\Search\Client\Model\DocumentListResponse', 'json');
        }
        if (404 === $status) {
            throw new \Silverstripe\Search\Client\Exception\DocumentsListPostNotFoundException($response);
        }
        if (is_null($contentType) === false && (422 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \Silverstripe\Search\Client\Exception\DocumentsListPostUnprocessableEntityException($serializer->deserialize($body, 'Silverstripe\Search\Client\Model\HTTPValidationError', 'json'), $response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['HTTPBearer'];
    }
}