<?php

namespace Silverstripe\Search\Client\Endpoint;

class CurationDocumentsDelete extends \Silverstripe\Search\Client\Runtime\Client\BaseEndpoint implements \Silverstripe\Search\Client\Runtime\Client\Endpoint
{
    protected $curation_id;
    protected $document_id;
    protected $engine_name;
    /**
     * Remove a document from a curation.
     * @param string $curationId
     * @param string $documentId
     * @param string $engineName
     */
    public function __construct(string $curationId, string $documentId, string $engineName)
    {
        $this->curation_id = $curationId;
        $this->document_id = $documentId;
        $this->engine_name = $engineName;
    }
    use \Silverstripe\Search\Client\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'DELETE';
    }
    public function getUri(): string
    {
        return str_replace(['{curation_id}', '{document_id}', '{engine_name}'], [$this->curation_id, $this->document_id, $this->engine_name], '/{engine_name}/curations/{curation_id}/documents/{document_id}');
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
     * @throws \Silverstripe\Search\Client\Exception\CurationDocumentsDeleteNotFoundException
     * @throws \Silverstripe\Search\Client\Exception\CurationDocumentsDeleteUnprocessableEntityException
     * @throws \Silverstripe\Search\Client\Exception\UnexpectedStatusCodeException
     *
     * @return \Silverstripe\Search\Client\Model\ResponseSuccess
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && mb_strpos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Silverstripe\Search\Client\Model\ResponseSuccess', 'json');
        }
        if (404 === $status) {
            throw new \Silverstripe\Search\Client\Exception\CurationDocumentsDeleteNotFoundException($response);
        }
        if (is_null($contentType) === false && (422 === $status && mb_strpos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Silverstripe\Search\Client\Exception\CurationDocumentsDeleteUnprocessableEntityException($serializer->deserialize($body, 'Silverstripe\Search\Client\Model\HTTPValidationError', 'json'), $response);
        }
        throw new \Silverstripe\Search\Client\Exception\UnexpectedStatusCodeException($status, $body);
    }
    public function getAuthenticationScopes(): array
    {
        return ['HTTPBearer'];
    }
}