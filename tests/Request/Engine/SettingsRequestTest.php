<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Tests\Request\Engine;

use PHPUnit\Framework\TestCase;
use Silverstripe\Search\Client\Request\Engine\SettingsRequest;

class SettingsRequestTest extends TestCase
{

    public function testJsonSerialize(): void
    {
        $request = new SettingsRequest(3);

        $this->assertSame(3, $request->getPrecision());
        $this->assertSame(
            ['precision' => 3],
            $request->jsonSerialize(),
        );
    }

}
