<?php

namespace Silverstripe\Search\Client\Endpoint;

class SchemaPost extends \Silverstripe\Search\Client\Runtime\Client\BaseEndpoint implements \Silverstripe\Search\Client\Runtime\Client\Endpoint
{
    protected $engine_name;
    /**
    * **Field types:**
    
    * `text`
    * `number`
    * `date`
       * Strings containing formatted dates, e.g. "2015-01-01" or "2015/01/01 12:10:30".
       * A number representing seconds-since-the-epoch.
    * `geolocation`
    
    **Field names:**
    
    * Must contain a lowercase letter and may only contain lowercase letters, numbers, and underscores.
    * Must not contain whitespace or have a leading underscore.
    * Must not contain more than 64 characters.
    * Must not be any of the following reserved words:
       * `id`
       * `engine_id`
       * `search_index_id`
       * `highlight`
       * `any`
       * `all`
       * `none`
       * `or`
       * `and`
       * `not`
    * The following fields can be used, but must be of type `text`
       * `body`
    * The following fields can be used, but must be of type `binary`
       * `_attachment`
    *
    * @param string $engineName 
    * @param \stdClass $requestBody 
    */
    public function __construct(string $engineName, \stdClass $requestBody)
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
        return str_replace(['{engine_name}'], [$this->engine_name], '/{engine_name}/schema');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \stdClass) {
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
     * @throws \Silverstripe\Search\Client\Exception\SchemaPostNotFoundException
     * @throws \Silverstripe\Search\Client\Exception\SchemaPostUnprocessableEntityException
     *
     * @return null|\Silverstripe\Search\Client\Model\SchemaPostResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Silverstripe\Search\Client\Model\SchemaPostResponse', 'json');
        }
        if (404 === $status) {
            throw new \Silverstripe\Search\Client\Exception\SchemaPostNotFoundException($response);
        }
        if (is_null($contentType) === false && (422 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \Silverstripe\Search\Client\Exception\SchemaPostUnprocessableEntityException($serializer->deserialize($body, 'Silverstripe\Search\Client\Model\HTTPValidationError', 'json'), $response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['HTTPBearer'];
    }
}