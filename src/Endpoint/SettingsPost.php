<?php

namespace Silverstripe\Search\Client\Endpoint;

class SettingsPost extends \Silverstripe\Search\Client\Runtime\Client\BaseEndpoint implements \Silverstripe\Search\Client\Runtime\Client\Endpoint
{
    protected $engine_name;
    /**
     * **Body:**
     *
     * `precision` (optional)
     * * Precision tuning setting for your engine
     * * Valid options are 1 - 11 (inclusive)
     * * 1: Highest recall (least precise)
     * * 2: Default: Less than half of the terms have to match. Full typo tolerance is applied
     * * 3: Increased term requirements: To match, documents must contain all terms for queries with up to 2 terms, then half if there are more. Full typo tolerance is applied
     * * 4: Increased term requirements: To match, documents must contain all terms for queries with up to 3 terms, then three-quarters if there are more. Full typo tolerance is applied
     * * 5: Increased term requirements: To match, documents must contain all terms for queries with up to 4 terms, then all but one if there are more. Full typo tolerance is applied
     * * 6: Increased term requirements: To match, documents must contain all terms for any query. Full typo tolerance is applied
     * * 7: Strictest term requirements: To match, documents must contain all terms in the same field. Full typo tolerance is applied
     * * 8: Strictest term requirements: To match, documents must contain all terms in the same field. Partial typo tolerance is applied: fuzzy matching is disabled
     * * 9: Strictest term requirements: To match, documents must contain all terms in the same field. Partial typo tolerance is applied: fuzzy matching and prefixing are disabled
     * * 10: Strictest term requirements: To match, documents must contain all terms in the same field. Partial typo tolerance is applied: in addition to the above, contractions and hyphenations are not corrected
     * * 11: Only exact matches will apply, with tolerance only for differences in capitalization (most precise)
     * @param string $engineName
     * @param \Silverstripe\Search\Client\Model\SettingsRequest $requestBody
     */
    public function __construct(string $engineName, \Silverstripe\Search\Client\Model\SettingsRequest $requestBody)
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
        return str_replace(['{engine_name}'], [$this->engine_name], '/{engine_name}/settings');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \Silverstripe\Search\Client\Model\SettingsRequest) {
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
     * @throws \Silverstripe\Search\Client\Exception\SettingsPostNotFoundException
     * @throws \Silverstripe\Search\Client\Exception\SettingsPostUnprocessableEntityException
     * @throws \Silverstripe\Search\Client\Exception\UnexpectedStatusCodeException
     *
     * @return \Silverstripe\Search\Client\Model\SettingsResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && mb_strpos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Silverstripe\Search\Client\Model\SettingsResponse', 'json');
        }
        if (404 === $status) {
            throw new \Silverstripe\Search\Client\Exception\SettingsPostNotFoundException($response);
        }
        if (is_null($contentType) === false && (422 === $status && mb_strpos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Silverstripe\Search\Client\Exception\SettingsPostUnprocessableEntityException($serializer->deserialize($body, 'Silverstripe\Search\Client\Model\HTTPValidationError', 'json'), $response);
        }
        throw new \Silverstripe\Search\Client\Exception\UnexpectedStatusCodeException($status, $body);
    }
    public function getAuthenticationScopes(): array
    {
        return ['HTTPBearer'];
    }
}