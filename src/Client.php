<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client;

use JsonException;
use JsonSerializable;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Silverstripe\Search\Client\Request\Analytics\ClickRequest;
use Silverstripe\Search\Client\Request\Boost\BoostPatchRequest;
use Silverstripe\Search\Client\Request\Boost\BoostPostRequest;
use Silverstripe\Search\Client\Request\Curation\CurationDocumentPatchRequest;
use Silverstripe\Search\Client\Request\Curation\CurationDocumentPostRequest;
use Silverstripe\Search\Client\Request\Curation\CurationPatchRequest;
use Silverstripe\Search\Client\Request\Curation\CurationPostRequest;
use Silverstripe\Search\Client\Request\Curation\CurationQueryPostRequest;
use Silverstripe\Search\Client\Request\Document\DocumentListRequest;
use Silverstripe\Search\Client\Request\Engine\SettingsRequest;
use Silverstripe\Search\Client\Request\Engine\SynonymRuleRequest;
use Silverstripe\Search\Client\Request\Search\QuerySuggestionRequest;
use Silverstripe\Search\Client\Request\Search\SearchRequest;
use Silverstripe\Search\Client\Request\Search\SpellingSuggestionRequest;

readonly class Client
{

    public function __construct(
        private ClientInterface $httpClient,
        private RequestFactoryInterface $requestFactory,
        private StreamFactoryInterface $streamFactory,
    ) {
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function search(string $engineName, SearchRequest $request): ResponseInterface
    {
        return $this->sendRequest('POST', sprintf('/%s/search', $engineName), $request);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function querySuggestion(string $engineName, QuerySuggestionRequest $request): ResponseInterface
    {
        return $this->sendRequest('POST', sprintf('/%s/query_suggestion', $engineName), $request);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function spellingSuggestion(string $engineName, SpellingSuggestionRequest $request): ResponseInterface
    {
        return $this->sendRequest('POST', sprintf('/%s/spelling_suggestion', $engineName), $request);
    }

    /**
     * @param array<int, array<string, mixed>> $documents
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function documentsPost(string $engineName, array $documents): ResponseInterface
    {
        return $this->sendRequest('POST', sprintf('/%s/documents', $engineName), $documents);
    }

    /**
     * @param array<int, array<string, mixed>> $documents
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function documentsPatch(string $engineName, array $documents): ResponseInterface
    {
        return $this->sendRequest('PATCH', sprintf('/%s/documents', $engineName), $documents);
    }

    /**
     * @param string[] $documentIds
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function documentsDelete(string $engineName, array $documentIds): ResponseInterface
    {
        return $this->sendRequest('DELETE', sprintf('/%s/documents', $engineName), $documentIds);
    }

    /**
     * @param string[] $documentIds
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function documentsGet(string $engineName, array $documentIds): ResponseInterface
    {
        return $this->sendRequest('GET', sprintf('/%s/documents', $engineName), $documentIds);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function documentsList(string $engineName, ?DocumentListRequest $request = null): ResponseInterface
    {
        return $this->sendRequest('POST', sprintf('/%s/documents/list', $engineName), $request);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function schemaGet(string $engineName): ResponseInterface
    {
        return $this->sendRequest('GET', sprintf('/%s/schema', $engineName));
    }

    /**
     * @param array<string, string> $schema
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function schemaPost(string $engineName, array $schema): ResponseInterface
    {
        return $this->sendRequest('POST', sprintf('/%s/schema', $engineName), $schema);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function schemaDelete(string $engineName, ?int $token = null): ResponseInterface
    {
        $uri = sprintf('/%s/schema', $engineName);

        if ($token !== null) {
            $uri .= sprintf('?token=%d', $token);
        }

        return $this->sendRequest('DELETE', $uri);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function settingsGet(string $engineName): ResponseInterface
    {
        return $this->sendRequest('GET', sprintf('/%s/settings', $engineName));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function settingsPost(string $engineName, SettingsRequest $request): ResponseInterface
    {
        return $this->sendRequest('POST', sprintf('/%s/settings', $engineName), $request);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function synonymRulesGet(string $engineName): ResponseInterface
    {
        return $this->sendRequest('GET', sprintf('/%s/synonyms', $engineName));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function synonymRuleGet(string $engineName, string $ruleId): ResponseInterface
    {
        return $this->sendRequest('GET', sprintf('/%s/synonyms/%s', $engineName, $ruleId));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function synonymRulePost(string $engineName, SynonymRuleRequest $request): ResponseInterface
    {
        return $this->sendRequest('POST', sprintf('/%s/synonyms', $engineName), $request);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function synonymRulePut(string $engineName, string $ruleId, SynonymRuleRequest $request): ResponseInterface
    {
        return $this->sendRequest('PUT', sprintf('/%s/synonyms/%s', $engineName, $ruleId), $request);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function synonymRuleDelete(string $engineName, string $ruleId): ResponseInterface
    {
        return $this->sendRequest('DELETE', sprintf('/%s/synonyms/%s', $engineName, $ruleId));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function enginesPost(): ResponseInterface
    {
        return $this->sendRequest('POST', '/engines');
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function clickPost(string $engineName, ClickRequest $request): ResponseInterface
    {
        return $this->sendRequest('POST', sprintf('/%s/click', $engineName), $request);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function boostsGet(string $engineName, string $fieldName): ResponseInterface
    {
        return $this->sendRequest('GET', sprintf('/%s/field/%s/boosts', $engineName, $fieldName));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function boostGet(string $engineName, string $fieldName, string $boostId): ResponseInterface
    {
        return $this->sendRequest('GET', sprintf('/%s/field/%s/boosts/%s', $engineName, $fieldName, $boostId));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function boostPost(string $engineName, string $fieldName, BoostPostRequest $request): ResponseInterface
    {
        return $this->sendRequest('POST', sprintf('/%s/field/%s/boosts', $engineName, $fieldName), $request);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function boostPatch(
        string $engineName,
        string $fieldName,
        string $boostId,
        BoostPatchRequest $request,
    ): ResponseInterface {
        return $this->sendRequest(
            'PATCH',
            sprintf('/%s/field/%s/boosts/%s', $engineName, $fieldName, $boostId),
            $request,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function boostDelete(string $engineName, string $fieldName, string $boostId): ResponseInterface
    {
        return $this->sendRequest('DELETE', sprintf('/%s/field/%s/boosts/%s', $engineName, $fieldName, $boostId));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function curationsGet(string $engineName): ResponseInterface
    {
        return $this->sendRequest('GET', sprintf('/%s/curations', $engineName));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function curationGet(string $engineName, string $curationId): ResponseInterface
    {
        return $this->sendRequest('GET', sprintf('/%s/curations/%s', $engineName, $curationId));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function curationPost(string $engineName, CurationPostRequest $request): ResponseInterface
    {
        return $this->sendRequest('POST', sprintf('/%s/curations', $engineName), $request);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function curationPatch(
        string $engineName,
        string $curationId,
        CurationPatchRequest $request,
    ): ResponseInterface {
        return $this->sendRequest('PATCH', sprintf('/%s/curations/%s', $engineName, $curationId), $request);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function curationDelete(string $engineName, string $curationId): ResponseInterface
    {
        return $this->sendRequest('DELETE', sprintf('/%s/curations/%s', $engineName, $curationId));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function curationDocumentsGet(string $engineName, string $curationId): ResponseInterface
    {
        return $this->sendRequest('GET', sprintf('/%s/curations/%s/documents', $engineName, $curationId));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function curationDocumentGet(
        string $engineName,
        string $curationId,
        string $documentId,
    ): ResponseInterface {
        return $this->sendRequest(
            'GET',
            sprintf('/%s/curations/%s/documents/%s', $engineName, $curationId, $documentId),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function curationDocumentPost(
        string $engineName,
        string $curationId,
        CurationDocumentPostRequest $request,
    ): ResponseInterface {
        return $this->sendRequest('POST', sprintf('/%s/curations/%s/documents', $engineName, $curationId), $request);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function curationDocumentPatch(
        string $engineName,
        string $curationId,
        string $documentId,
        CurationDocumentPatchRequest $request,
    ): ResponseInterface {
        return $this->sendRequest(
            'PATCH',
            sprintf('/%s/curations/%s/documents/%s', $engineName, $curationId, $documentId),
            $request,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function curationDocumentDelete(
        string $engineName,
        string $curationId,
        string $documentId,
    ): ResponseInterface {
        return $this->sendRequest(
            'DELETE',
            sprintf('/%s/curations/%s/documents/%s', $engineName, $curationId, $documentId),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function curationQueriesGet(string $engineName, string $curationId): ResponseInterface
    {
        return $this->sendRequest('GET', sprintf('/%s/curations/%s/queries', $engineName, $curationId));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function curationQueryGet(string $engineName, string $curationId, string $queryId): ResponseInterface
    {
        return $this->sendRequest(
            'GET',
            sprintf('/%s/curations/%s/queries/%s', $engineName, $curationId, $queryId),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function curationQueryPost(
        string $engineName,
        string $curationId,
        CurationQueryPostRequest $request,
    ): ResponseInterface {
        return $this->sendRequest('POST', sprintf('/%s/curations/%s/queries', $engineName, $curationId), $request);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function curationQueryDelete(string $engineName, string $curationId, string $queryId): ResponseInterface
    {
        return $this->sendRequest(
            'DELETE',
            sprintf('/%s/curations/%s/queries/%s', $engineName, $curationId, $queryId),
        );
    }

    /**
     * @throws JsonException
     * @throws ClientExceptionInterface
     */
    private function sendRequest(
        string $method,
        string $uri,
        JsonSerializable|array|null $body = null,
    ): ResponseInterface {
        $request = $this->requestFactory->createRequest($method, $uri);
        $request = $request->withHeader('Content-Type', 'application/json');

        if ($body !== null) {
            $json = json_encode($body, JSON_THROW_ON_ERROR);
            $stream = $this->streamFactory->createStream($json);
            $request = $request->withBody($stream);
        }

        return $this->httpClient->sendRequest($request);
    }

}
