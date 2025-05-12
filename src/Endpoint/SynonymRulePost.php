<?php

namespace Silverstripe\Search\Client\Endpoint;

class SynonymRulePost extends \Silverstripe\Search\Client\Runtime\Client\BaseEndpoint implements \Silverstripe\Search\Client\Runtime\Client\Endpoint
{
    protected $engine_name;
    /**
    * The POST method will automatically generate an ID for your synonym.
    
    Our synonym format supports two styles of definition:
    
    * Equivalent synonyms: Groups of words, where any word in the group is a valid replacement. Example:
       * "ipod, i-pod, i pod"
       * "computer, pc, laptop"
    * Explicit synonyms: Groups of words that are replaced by a second group of words. IE words on the left are replaced
     (and expanded) into the words on the right. Example:
       * "pc => personal computer"
       * "js => javascript, es6"
       * "sea biscuit, sea biscit => seabiscuit"
    * A maximum of 32 words can be added to a synonym
    *
    * @param string $engineName 
    * @param \Silverstripe\Search\Client\Model\SynonymRuleRequest $requestBody 
    */
    public function __construct(string $engineName, \Silverstripe\Search\Client\Model\SynonymRuleRequest $requestBody)
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
        return str_replace(['{engine_name}'], [$this->engine_name], '/{engine_name}/synonyms');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \Silverstripe\Search\Client\Model\SynonymRuleRequest) {
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
     * @throws \Silverstripe\Search\Client\Exception\SynonymRulePostNotFoundException
     * @throws \Silverstripe\Search\Client\Exception\SynonymRulePostUnprocessableEntityException
     *
     * @return null|\Silverstripe\Search\Client\Model\SynonymRule
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Silverstripe\Search\Client\Model\SynonymRule', 'json');
        }
        if (404 === $status) {
            throw new \Silverstripe\Search\Client\Exception\SynonymRulePostNotFoundException($response);
        }
        if (is_null($contentType) === false && (422 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \Silverstripe\Search\Client\Exception\SynonymRulePostUnprocessableEntityException($serializer->deserialize($body, 'Silverstripe\Search\Client\Model\HTTPValidationError', 'json'), $response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['HTTPBearer'];
    }
}