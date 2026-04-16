<?php

namespace Silverstripe\Search\Client\Endpoint;

class CurationDocumentsPost extends \Silverstripe\Search\Client\Runtime\Client\BaseEndpoint implements \Silverstripe\Search\Client\Runtime\Client\Endpoint
{
    protected $curation_id;
    protected $engine_name;
    /**
     * Add a document to a curation.
     *
     * The 'type' field determines how the document is curated:
     * - 0 (HIDDEN): Document is hidden from search results for this curation
     * - 1 (PROMOTED): Document is promoted in search results for this curation
     *
     * A maximum of 20 Documents can be added for each Curation Type (HIDDEN, PROMOTED).
     * @param string $curationId
     * @param string $engineName
     * @param \Silverstripe\Search\Client\Model\CommonModelsCurationDocumentPostRequestPostRequest $requestBody
     */
    public function __construct(string $curationId, string $engineName, \Silverstripe\Search\Client\Model\CommonModelsCurationDocumentPostRequestPostRequest $requestBody)
    {
        $this->curation_id = $curationId;
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
        return str_replace(['{curation_id}', '{engine_name}'], [$this->curation_id, $this->engine_name], '/{engine_name}/curations/{curation_id}/documents');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \Silverstripe\Search\Client\Model\CommonModelsCurationDocumentPostRequestPostRequest) {
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
     * @throws \Silverstripe\Search\Client\Exception\CurationDocumentsPostNotFoundException
     * @throws \Silverstripe\Search\Client\Exception\CurationDocumentsPostUnprocessableEntityException
     * @throws \Silverstripe\Search\Client\Exception\UnexpectedStatusCodeException
     *
     * @return \Silverstripe\Search\Client\Model\CommonModelsCurationDocumentGetResponseGetResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && mb_strpos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Silverstripe\Search\Client\Model\CommonModelsCurationDocumentGetResponseGetResponse', 'json');
        }
        if (404 === $status) {
            throw new \Silverstripe\Search\Client\Exception\CurationDocumentsPostNotFoundException($response);
        }
        if (is_null($contentType) === false && (422 === $status && mb_strpos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Silverstripe\Search\Client\Exception\CurationDocumentsPostUnprocessableEntityException($serializer->deserialize($body, 'Silverstripe\Search\Client\Model\HTTPValidationError', 'json'), $response);
        }
        throw new \Silverstripe\Search\Client\Exception\UnexpectedStatusCodeException($status, $body);
    }
    public function getAuthenticationScopes(): array
    {
        return ['HTTPBearer'];
    }
}