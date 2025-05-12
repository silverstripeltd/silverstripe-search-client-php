<?php

namespace Silverstripe\Search\Client\Endpoint;

class SpellingSuggestionPost extends \Silverstripe\Search\Client\Runtime\Client\BaseEndpoint implements \Silverstripe\Search\Client\Runtime\Client\Endpoint
{
    protected $engine_name;
    /**
    * Provide relevant spelling suggestions for queries. Not to be confused with autocomplete.
    
    Only available on text fields.
    
    **Body:**
    
    `query` **(required)**
    * A query for which to receive spelling suggestions.
    
    `fields` **(required)**
    * Specify the fields within your documents that you would like spelling suggestions from. At least one field is
     required.
    
    `size` (optional)
    * Number of spelling suggestions to return. Must be between 1 and 10. Defaults to 1.
    *
    * @param string $engineName 
    * @param \Silverstripe\Search\Client\Model\SpellingSuggestionRequest $requestBody 
    */
    public function __construct(string $engineName, \Silverstripe\Search\Client\Model\SpellingSuggestionRequest $requestBody)
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
        return str_replace(['{engine_name}'], [$this->engine_name], '/{engine_name}/spelling_suggestion');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \Silverstripe\Search\Client\Model\SpellingSuggestionRequest) {
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
     * @throws \Silverstripe\Search\Client\Exception\SpellingSuggestionPostNotFoundException
     * @throws \Silverstripe\Search\Client\Exception\SpellingSuggestionPostUnprocessableEntityException
     *
     * @return null|\Silverstripe\Search\Client\Model\SpellingSuggestionResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Silverstripe\Search\Client\Model\SpellingSuggestionResponse', 'json');
        }
        if (404 === $status) {
            throw new \Silverstripe\Search\Client\Exception\SpellingSuggestionPostNotFoundException($response);
        }
        if (is_null($contentType) === false && (422 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \Silverstripe\Search\Client\Exception\SpellingSuggestionPostUnprocessableEntityException($serializer->deserialize($body, 'Silverstripe\Search\Client\Model\HTTPValidationError', 'json'), $response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['HTTPBearer'];
    }
}