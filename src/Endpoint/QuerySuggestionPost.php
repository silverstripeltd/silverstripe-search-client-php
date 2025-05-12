<?php

namespace Silverstripe\Search\Client\Endpoint;

class QuerySuggestionPost extends \Silverstripe\Search\Client\Runtime\Client\BaseEndpoint implements \Silverstripe\Search\Client\Runtime\Client\Endpoint
{
    protected $engine_name;
    /**
    * Provide relevant query suggestions for incomplete queries. Also known as Autocomplete.
    
    Only available on text fields.
    
    **Body:**
    
    `query` **(required)**
    * A partial query for which to receive suggestions.
    
    `types` (optional)
    * Specify the documents key within the types parameter to look for suggestions within certain text fields. Defaults to all text fields.
    
    `size` (optional)
    * Number of query suggestions to return. Must be between 1 and 20. Defaults to 10.
    *
    * @param string $engineName 
    * @param \Silverstripe\Search\Client\Model\QuerySuggestionRequest $requestBody 
    */
    public function __construct(string $engineName, \Silverstripe\Search\Client\Model\QuerySuggestionRequest $requestBody)
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
        return str_replace(['{engine_name}'], [$this->engine_name], '/{engine_name}/query_suggestion');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \Silverstripe\Search\Client\Model\QuerySuggestionRequest) {
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
     * @throws \Silverstripe\Search\Client\Exception\QuerySuggestionPostNotFoundException
     * @throws \Silverstripe\Search\Client\Exception\QuerySuggestionPostUnprocessableEntityException
     *
     * @return null|\Silverstripe\Search\Client\Model\QuerySuggestionResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Silverstripe\Search\Client\Model\QuerySuggestionResponse', 'json');
        }
        if (404 === $status) {
            throw new \Silverstripe\Search\Client\Exception\QuerySuggestionPostNotFoundException($response);
        }
        if (is_null($contentType) === false && (422 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \Silverstripe\Search\Client\Exception\QuerySuggestionPostUnprocessableEntityException($serializer->deserialize($body, 'Silverstripe\Search\Client\Model\HTTPValidationError', 'json'), $response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['HTTPBearer'];
    }
}