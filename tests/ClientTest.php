<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Tests;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;
use Silverstripe\Search\Client\Client;
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

class ClientTest extends TestCase
{

    private ClientInterface&MockObject $httpClient;

    private RequestFactoryInterface&MockObject $requestFactory;

    private StreamFactoryInterface&MockObject $streamFactory;

    private Client $client;

    protected function setUp(): void
    {
        $this->httpClient = $this->createMock(ClientInterface::class);
        $this->requestFactory = $this->createMock(RequestFactoryInterface::class);
        $this->streamFactory = $this->createMock(StreamFactoryInterface::class);

        $this->client = new Client($this->httpClient, $this->requestFactory, $this->streamFactory);
    }

    private function expectRequest(string $method, string $uri, bool $hasBody = true): void
    {
        $request = $this->createMock(RequestInterface::class);
        $response = $this->createMock(ResponseInterface::class);

        $this->requestFactory
            ->expects($this->once())
            ->method('createRequest')
            ->with($method, $uri)
            ->willReturn($request);

        $request->expects($this->once())
            ->method('withHeader')
            ->with('Content-Type', 'application/json')
            ->willReturn($request);

        if ($hasBody) {
            $stream = $this->createMock(StreamInterface::class);

            $this->streamFactory
                ->expects($this->once())
                ->method('createStream')
                ->willReturn($stream);

            $request->expects($this->once())
                ->method('withBody')
                ->with($stream)
                ->willReturn($request);
        }

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->with($request)
            ->willReturn($response);
    }

    public function testSearch(): void
    {
        $this->expectRequest('POST', '/my-engine/search');

        $this->assertInstanceOf(
            ResponseInterface::class,
            $this->client->search('my-engine', new SearchRequest('test')),
        );
    }

    public function testQuerySuggestion(): void
    {
        $this->expectRequest('POST', '/my-engine/query_suggestion');

        $this->client->querySuggestion('my-engine', new QuerySuggestionRequest('test'));
    }

    public function testSpellingSuggestion(): void
    {
        $this->expectRequest('POST', '/my-engine/spelling_suggestion');

        $this->client->spellingSuggestion('my-engine', new SpellingSuggestionRequest('tset', ['title']));
    }

    public function testDocumentsPost(): void
    {
        $this->expectRequest('POST', '/my-engine/documents');

        $this->client->documentsPost('my-engine', [['id' => '1', 'title' => 'Test']]);
    }

    public function testDocumentsPatch(): void
    {
        $this->expectRequest('PATCH', '/my-engine/documents');

        $this->client->documentsPatch('my-engine', [['id' => '1', 'title' => 'Updated']]);
    }

    public function testDocumentsDelete(): void
    {
        $this->expectRequest('DELETE', '/my-engine/documents');

        $this->client->documentsDelete('my-engine', ['doc-1', 'doc-2']);
    }

    public function testDocumentsGet(): void
    {
        $this->expectRequest('GET', '/my-engine/documents');

        $this->client->documentsGet('my-engine', ['doc-1']);
    }

    public function testDocumentsList(): void
    {
        $this->expectRequest('POST', '/my-engine/documents/list');

        $this->client->documentsList('my-engine', new DocumentListRequest());
    }

    public function testDocumentsListWithoutRequest(): void
    {
        $this->expectRequest('POST', '/my-engine/documents/list', false);

        $this->client->documentsList('my-engine');
    }

    public function testSchemaGet(): void
    {
        $this->expectRequest('GET', '/my-engine/schema', false);

        $this->client->schemaGet('my-engine');
    }

    public function testSchemaPost(): void
    {
        $this->expectRequest('POST', '/my-engine/schema');

        $this->client->schemaPost('my-engine', ['title' => 'text']);
    }

    public function testSchemaDelete(): void
    {
        $this->expectRequest('DELETE', '/my-engine/schema', false);

        $this->client->schemaDelete('my-engine');
    }

    public function testSchemaDeleteWithToken(): void
    {
        $this->expectRequest('DELETE', '/my-engine/schema?token=12345', false);

        $this->client->schemaDelete('my-engine', 12345);
    }

    public function testSettingsGet(): void
    {
        $this->expectRequest('GET', '/my-engine/settings', false);

        $this->client->settingsGet('my-engine');
    }

    public function testSettingsPost(): void
    {
        $this->expectRequest('POST', '/my-engine/settings');

        $this->client->settingsPost('my-engine', new SettingsRequest(3));
    }

    public function testSynonymRulesGet(): void
    {
        $this->expectRequest('GET', '/my-engine/synonyms', false);

        $this->client->synonymRulesGet('my-engine');
    }

    public function testSynonymRuleGet(): void
    {
        $this->expectRequest('GET', '/my-engine/synonyms/rule-1', false);

        $this->client->synonymRuleGet('my-engine', 'rule-1');
    }

    public function testSynonymRulePost(): void
    {
        $this->expectRequest('POST', '/my-engine/synonyms');

        $this->client->synonymRulePost('my-engine', new SynonymRuleRequest('foo, bar'));
    }

    public function testSynonymRulePut(): void
    {
        $this->expectRequest('PUT', '/my-engine/synonyms/rule-1');

        $this->client->synonymRulePut('my-engine', 'rule-1', new SynonymRuleRequest('foo, bar'));
    }

    public function testSynonymRuleDelete(): void
    {
        $this->expectRequest('DELETE', '/my-engine/synonyms/rule-1', false);

        $this->client->synonymRuleDelete('my-engine', 'rule-1');
    }

    public function testEnginesPost(): void
    {
        $this->expectRequest('POST', '/engines', false);

        $this->client->enginesPost();
    }

    public function testClickPost(): void
    {
        $this->expectRequest('POST', '/my-engine/click');

        $this->client->clickPost('my-engine', new ClickRequest('req-1', 'doc-1'));
    }

    public function testBoostsGet(): void
    {
        $this->expectRequest('GET', '/my-engine/field/title/boosts', false);

        $this->client->boostsGet('my-engine', 'title');
    }

    public function testBoostGet(): void
    {
        $this->expectRequest('GET', '/my-engine/field/title/boosts/boost-1', false);

        $this->client->boostGet('my-engine', 'title', 'boost-1');
    }

    public function testBoostPost(): void
    {
        $this->expectRequest('POST', '/my-engine/field/title/boosts');

        $this->client->boostPost('my-engine', 'title', new BoostPostRequest('value', 1.5));
    }

    public function testBoostPatch(): void
    {
        $this->expectRequest('PATCH', '/my-engine/field/title/boosts/boost-1');

        $request = new BoostPatchRequest();
        $request->setImpact(2.0);

        $this->client->boostPatch('my-engine', 'title', 'boost-1', $request);
    }

    public function testBoostDelete(): void
    {
        $this->expectRequest('DELETE', '/my-engine/field/title/boosts/boost-1', false);

        $this->client->boostDelete('my-engine', 'title', 'boost-1');
    }

    public function testCurationsGet(): void
    {
        $this->expectRequest('GET', '/my-engine/curations', false);

        $this->client->curationsGet('my-engine');
    }

    public function testCurationGet(): void
    {
        $this->expectRequest('GET', '/my-engine/curations/cur-1', false);

        $this->client->curationGet('my-engine', 'cur-1');
    }

    public function testCurationPost(): void
    {
        $this->expectRequest('POST', '/my-engine/curations');

        $this->client->curationPost('my-engine', new CurationPostRequest());
    }

    public function testCurationPatch(): void
    {
        $this->expectRequest('PATCH', '/my-engine/curations/cur-1');

        $this->client->curationPatch('my-engine', 'cur-1', new CurationPatchRequest());
    }

    public function testCurationDelete(): void
    {
        $this->expectRequest('DELETE', '/my-engine/curations/cur-1', false);

        $this->client->curationDelete('my-engine', 'cur-1');
    }

    public function testCurationDocumentsGet(): void
    {
        $this->expectRequest('GET', '/my-engine/curations/cur-1/documents', false);

        $this->client->curationDocumentsGet('my-engine', 'cur-1');
    }

    public function testCurationDocumentGet(): void
    {
        $this->expectRequest('GET', '/my-engine/curations/cur-1/documents/doc-1', false);

        $this->client->curationDocumentGet('my-engine', 'cur-1', 'doc-1');
    }

    public function testCurationDocumentPost(): void
    {
        $this->expectRequest('POST', '/my-engine/curations/cur-1/documents');

        $this->client->curationDocumentPost('my-engine', 'cur-1', new CurationDocumentPostRequest('doc-1', 1, 0));
    }

    public function testCurationDocumentPatch(): void
    {
        $this->expectRequest('PATCH', '/my-engine/curations/cur-1/documents/doc-1');

        $this->client->curationDocumentPatch('my-engine', 'cur-1', 'doc-1', new CurationDocumentPatchRequest());
    }

    public function testCurationDocumentDelete(): void
    {
        $this->expectRequest('DELETE', '/my-engine/curations/cur-1/documents/doc-1', false);

        $this->client->curationDocumentDelete('my-engine', 'cur-1', 'doc-1');
    }

    public function testCurationQueriesGet(): void
    {
        $this->expectRequest('GET', '/my-engine/curations/cur-1/queries', false);

        $this->client->curationQueriesGet('my-engine', 'cur-1');
    }

    public function testCurationQueryGet(): void
    {
        $this->expectRequest('GET', '/my-engine/curations/cur-1/queries/q-1', false);

        $this->client->curationQueryGet('my-engine', 'cur-1', 'q-1');
    }

    public function testCurationQueryPost(): void
    {
        $this->expectRequest('POST', '/my-engine/curations/cur-1/queries');

        $this->client->curationQueryPost('my-engine', 'cur-1', new CurationQueryPostRequest('my query'));
    }

    public function testCurationQueryDelete(): void
    {
        $this->expectRequest('DELETE', '/my-engine/curations/cur-1/queries/q-1', false);

        $this->client->curationQueryDelete('my-engine', 'cur-1', 'q-1');
    }

}
