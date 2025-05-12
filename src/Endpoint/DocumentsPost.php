<?php

namespace Silverstripe\Search\Client\Endpoint;

class DocumentsPost extends \Silverstripe\Search\Client\Runtime\Client\BaseEndpoint implements \Silverstripe\Search\Client\Runtime\Client\Endpoint
{
    protected $engine_name;
    /**
    * Create or update documents.
    
    Documents are indexed asynchronously. There will be a processing delay before they are available to your Engine.
    
    **Key points to remember when creating documents:**
    
    * It is recommended that you provide your own `id` field, but If no `id` is provided, a unique `id` will be
     generated.
    * A new document is created each time content is received without an `id` - beware duplicates!
    * A document will be updated - not created - if its `id` already exists within a document.
    
    **Processing file contents**
    
    * An `_attachment` field can be used to attach PDF and Docx files to your document.
    * The _attachment` field should contain a base 64 encoded string of binary.
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
        return 'POST';
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
     * @throws \Silverstripe\Search\Client\Exception\DocumentsPostNotFoundException
     * @throws \Silverstripe\Search\Client\Exception\DocumentsPostUnprocessableEntityException
     *
     * @return null|\Silverstripe\Search\Client\Model\DocumentPostPatchResponse[]
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Silverstripe\Search\Client\Model\DocumentPostPatchResponse[]', 'json');
        }
        if (404 === $status) {
            throw new \Silverstripe\Search\Client\Exception\DocumentsPostNotFoundException($response);
        }
        if (is_null($contentType) === false && (422 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \Silverstripe\Search\Client\Exception\DocumentsPostUnprocessableEntityException($serializer->deserialize($body, 'Silverstripe\Search\Client\Model\HTTPValidationError', 'json'), $response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['HTTPBearer'];
    }
}