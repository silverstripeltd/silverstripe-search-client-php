<?php

namespace Silverstripe\Search\Client\Endpoint;

class CurationQueriesGetAll extends \Silverstripe\Search\Client\Runtime\Client\BaseEndpoint implements \Silverstripe\Search\Client\Runtime\Client\Endpoint
{
    protected $curation_id;
    protected $engine_name;
    /**
     * Retrieve all queries for a curation.
     * @param string $curationId
     * @param string $engineName
     */
    public function __construct(string $curationId, string $engineName)
    {
        $this->curation_id = $curationId;
        $this->engine_name = $engineName;
    }
    use \Silverstripe\Search\Client\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'GET';
    }
    public function getUri(): string
    {
        return str_replace(['{curation_id}', '{engine_name}'], [$this->curation_id, $this->engine_name], '/{engine_name}/curations/{curation_id}/queries');
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
     * @throws \Silverstripe\Search\Client\Exception\CurationQueriesGetAllNotFoundException
     * @throws \Silverstripe\Search\Client\Exception\CurationQueriesGetAllUnprocessableEntityException
     * @throws \Silverstripe\Search\Client\Exception\UnexpectedStatusCodeException
     *
     * @return \Silverstripe\Search\Client\Model\CommonModelsCurationQueryGetResponseGetResponse[]
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && mb_strpos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Silverstripe\Search\Client\Model\CommonModelsCurationQueryGetResponseGetResponse[]', 'json');
        }
        if (404 === $status) {
            throw new \Silverstripe\Search\Client\Exception\CurationQueriesGetAllNotFoundException($response);
        }
        if (is_null($contentType) === false && (422 === $status && mb_strpos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Silverstripe\Search\Client\Exception\CurationQueriesGetAllUnprocessableEntityException($serializer->deserialize($body, 'Silverstripe\Search\Client\Model\HTTPValidationError', 'json'), $response);
        }
        throw new \Silverstripe\Search\Client\Exception\UnexpectedStatusCodeException($status, $body);
    }
    public function getAuthenticationScopes(): array
    {
        return ['HTTPBearer'];
    }
}