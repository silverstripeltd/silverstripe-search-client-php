<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Tests\Request\Document;

use PHPUnit\Framework\TestCase;
use Silverstripe\Search\Client\Model\Pagination;
use Silverstripe\Search\Client\Request\Document\DocumentListRequest;

class DocumentListRequestTest extends TestCase
{

    public function testJsonSerializeEmpty(): void
    {
        $request = new DocumentListRequest();

        $this->assertNull($request->getPage());
        $this->assertSame([], $request->jsonSerialize());
    }

    public function testJsonSerializeWithPagination(): void
    {
        $request = new DocumentListRequest();
        $request->setPage(new Pagination(2, 25));

        $result = json_decode(json_encode($request), true);

        $this->assertSame(2, $result['page']['current']);
        $this->assertSame(25, $result['page']['size']);
    }

    public function testFluentSetters(): void
    {
        $request = new DocumentListRequest();

        $this->assertSame($request, $request->setPage(new Pagination()));
    }

}
