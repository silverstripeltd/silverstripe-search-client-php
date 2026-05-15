<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Tests\Request\Engine;

use PHPUnit\Framework\TestCase;
use Silverstripe\Search\Client\Request\Engine\SynonymRuleRequest;

class SynonymRuleRequestTest extends TestCase
{

    public function testJsonSerialize(): void
    {
        $request = new SynonymRuleRequest('foo, bar, baz');

        $this->assertSame('foo, bar, baz', $request->getSynonyms());
        $this->assertSame(
            ['synonyms' => 'foo, bar, baz'],
            $request->jsonSerialize(),
        );
    }

}
