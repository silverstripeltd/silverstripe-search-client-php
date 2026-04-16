<?php

namespace Silverstripe\Search\Client\Endpoint;

class CurationDocumentsPatch extends \Silverstripe\Search\Client\Runtime\Client\BaseEndpoint implements \Silverstripe\Search\Client\Runtime\Client\Endpoint
{
    protected $curation_id;
    protected $document_id;
    protected $engine_name;
    /**
     * Update a document in a curation.
     *
     * Only the fields provided in the request will be updated:
     * - type: 0 (HIDDEN) or 1 (PROMOTED)
     * - sort: The sort order for the document
     * @param string $curationId
     * @param string $documentId
     * @param string $engineName
     * @param \Silverstripe\Search\Client\Model\CommonModelsCurationDocumentPatchRequestPatchRequest $requestBody
     */
    public function __construct(string $curationId, string $documentId, string $engineName, \Silverstripe\Search\Client\Model\CommonModelsCurationDocumentPatchRequestPatchRequest $requestBody)
    {
        $this->curation_id = $curationId;
        $this->document_id = $documentId;
        $this->engine_name = $engineName;
        $this->body = $requestBody;
    }
    use \Silverstripe\Search\Client\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'PATCH';
    }
    public function getUri(): string
    {
        return str_replace(['{curation_id}', '{document_id}', '{engine_name}'], [$this->curation_id, $this->document_id, $this->engine_name], '/{engine_name}/curations/{curation_id}/documents/{document_id}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \Silverstripe\Search\Client\Model\CommonModelsCurationDocumentPatchRequestPatchRequest) {
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
     * @throws \Silverstripe\Search\Client\Exception\CurationDocumentsPatchNotFoundException
     * @throws \Silverstripe\Search\Client\Exception\CurationDocumentsPatchUnprocessableEntityException
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
            throw new \Silverstripe\Search\Client\Exception\CurationDocumentsPatchNotFoundException($response);
        }
        if (is_null($contentType) === false && (422 === $status && mb_strpos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Silverstripe\Search\Client\Exception\CurationDocumentsPatchUnprocessableEntityException($serializer->deserialize($body, 'Silverstripe\Search\Client\Model\HTTPValidationError', 'json'), $response);
        }
        throw new \Silverstripe\Search\Client\Exception\UnexpectedStatusCodeException($status, $body);
    }
    public function getAuthenticationScopes(): array
    {
        return ['HTTPBearer'];
    }
}