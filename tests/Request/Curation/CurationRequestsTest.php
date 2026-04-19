<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Tests\Request\Curation;

use PHPUnit\Framework\TestCase;
use Silverstripe\Search\Client\Request\Curation\CurationDocumentPatchRequest;
use Silverstripe\Search\Client\Request\Curation\CurationDocumentPostRequest;
use Silverstripe\Search\Client\Request\Curation\CurationPatchRequest;
use Silverstripe\Search\Client\Request\Curation\CurationPostRequest;
use Silverstripe\Search\Client\Request\Curation\CurationQueryPostRequest;
use stdClass;

class CurationRequestsTest extends TestCase
{

    public function testCurationPostRequest(): void
    {
        $request = new CurationPostRequest();
        $request->setName('My Curation');
        $request->setQueries(['test query']);

        $this->assertSame(
            ['name' => 'My Curation', 'queries' => ['test query']],
            $request->jsonSerialize(),
        );
    }

    public function testCurationPostRequestEmpty(): void
    {
        $request = new CurationPostRequest();

        $this->assertSame([], $request->jsonSerialize());
    }

    public function testCurationPatchRequestEmpty(): void
    {
        $request = new CurationPatchRequest();

        $this->assertInstanceOf(stdClass::class, $request->jsonSerialize());
        $this->assertSame('{}', json_encode($request));
    }

    public function testCurationPatchRequestWithName(): void
    {
        $request = new CurationPatchRequest();
        $request->setName('Updated Name');

        $this->assertSame(['name' => 'Updated Name'], $request->jsonSerialize());
    }

    public function testCurationDocumentPostRequest(): void
    {
        $request = new CurationDocumentPostRequest('doc-123', 1, 5);

        $this->assertSame('doc-123', $request->getDocumentId());
        $this->assertSame(1, $request->getType());
        $this->assertSame(5, $request->getSort());
        $this->assertSame(
            ['document_id' => 'doc-123', 'type' => 1, 'sort' => 5],
            $request->jsonSerialize(),
        );
    }

    public function testCurationDocumentPatchRequestEmpty(): void
    {
        $request = new CurationDocumentPatchRequest();

        $this->assertInstanceOf(stdClass::class, $request->jsonSerialize());
        $this->assertSame('{}', json_encode($request));
    }

    public function testCurationDocumentPatchRequestFull(): void
    {
        $request = new CurationDocumentPatchRequest();
        $request->setType(2);
        $request->setSort(10);

        $this->assertSame(
            ['type' => 2, 'sort' => 10],
            $request->jsonSerialize(),
        );
    }

    public function testCurationQueryPostRequest(): void
    {
        $request = new CurationQueryPostRequest('my query');

        $this->assertSame('my query', $request->getQuery());
        $this->assertSame(
            ['query' => 'my query'],
            $request->jsonSerialize(),
        );
    }

}
