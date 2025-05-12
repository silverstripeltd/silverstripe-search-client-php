<?php

namespace Silverstripe\Search\Client\Endpoint;

class SynonymRuleGet extends \Silverstripe\Search\Client\Runtime\Client\BaseEndpoint implements \Silverstripe\Search\Client\Runtime\Client\Endpoint
{
    protected $rule_id;
    protected $engine_name;
    /**
     * Retrieve a specific synonym by its ID.
     *
     * @param string $ruleId 
     * @param string $engineName 
     */
    public function __construct(string $ruleId, string $engineName)
    {
        $this->rule_id = $ruleId;
        $this->engine_name = $engineName;
    }
    use \Silverstripe\Search\Client\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'GET';
    }
    public function getUri(): string
    {
        return str_replace(['{rule_id}', '{engine_name}'], [$this->rule_id, $this->engine_name], '/{engine_name}/synonyms/{rule_id}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    /**
     * {@inheritdoc}
     *
     * @throws \Silverstripe\Search\Client\Exception\SynonymRuleGetNotFoundException
     * @throws \Silverstripe\Search\Client\Exception\SynonymRuleGetUnprocessableEntityException
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
            throw new \Silverstripe\Search\Client\Exception\SynonymRuleGetNotFoundException($response);
        }
        if (is_null($contentType) === false && (422 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \Silverstripe\Search\Client\Exception\SynonymRuleGetUnprocessableEntityException($serializer->deserialize($body, 'Silverstripe\Search\Client\Model\HTTPValidationError', 'json'), $response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['HTTPBearer'];
    }
}