<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Tests\Request\Analytics;

use PHPUnit\Framework\TestCase;
use Silverstripe\Search\Client\Request\Analytics\ClickRequest;

class ClickRequestTest extends TestCase
{

    public function testJsonSerialize(): void
    {
        $request = new ClickRequest('req-123', 'doc-456');

        $this->assertSame('req-123', $request->getRequestId());
        $this->assertSame('doc-456', $request->getDocumentId());
        $this->assertSame(
            ['request_id' => 'req-123', 'document_id' => 'doc-456'],
            $request->jsonSerialize(),
        );
    }

}
