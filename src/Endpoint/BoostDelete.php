<?php

namespace Silverstripe\Search\Client\Endpoint;

class BoostDelete extends \Silverstripe\Search\Client\Runtime\Client\BaseEndpoint implements \Silverstripe\Search\Client\Runtime\Client\Endpoint
{
    protected $field_name;
    protected $boost_id;
    protected $engine_name;
    /**
     * Delete a specific boost by its ID.
     * @param string $fieldName Name of the field
     * @param string $boostId ID of the boost to delete
     * @param string $engineName
     */
    public function __construct(string $fieldName, string $boostId, string $engineName)
    {
        $this->field_name = $fieldName;
        $this->boost_id = $boostId;
        $this->engine_name = $engineName;
    }
    use \Silverstripe\Search\Client\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'DELETE';
    }
    public function getUri(): string
    {
        return str_replace(['{field_name}', '{boost_id}', '{engine_name}'], [$this->field_name, $this->boost_id, $this->engine_name], '/{engine_name}/field/{field_name}/boosts/{boost_id}');
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
     * @throws \Silverstripe\Search\Client\Exception\BoostDeleteNotFoundException
     * @throws \Silverstripe\Search\Client\Exception\BoostDeleteUnprocessableEntityException
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
            throw new \Silverstripe\Search\Client\Exception\BoostDeleteNotFoundException($response);
        }
        if (is_null($contentType) === false && (422 === $status && mb_strpos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Silverstripe\Search\Client\Exception\BoostDeleteUnprocessableEntityException($serializer->deserialize($body, 'Silverstripe\Search\Client\Model\HTTPValidationError', 'json'), $response);
        }
        throw new \Silverstripe\Search\Client\Exception\UnexpectedStatusCodeException($status, $body);
    }
    public function getAuthenticationScopes(): array
    {
        return ['HTTPBearer'];
    }
}