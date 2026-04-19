<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Tests\Request\Boost;

use PHPUnit\Framework\TestCase;
use Silverstripe\Search\Client\Request\Boost\BoostPostRequest;

class BoostPostRequestTest extends TestCase
{

    public function testJsonSerializeMinimal(): void
    {
        $request = new BoostPostRequest('value', 1.5);

        $this->assertSame('value', $request->getType());
        $this->assertSame(1.5, $request->getImpact());
        $this->assertSame(
            ['type' => 'value', 'impact' => 1.5],
            $request->jsonSerialize(),
        );
    }

    public function testJsonSerializeFull(): void
    {
        $request = new BoostPostRequest('functional', 2.0);
        $request->setValues(['premium']);
        $request->setCenter('37.7749');
        $request->setFunction('linear');
        $request->setOperation('multiply');

        $this->assertSame(
            [
                'type' => 'functional',
                'impact' => 2.0,
                'values' => ['premium'],
                'center' => '37.7749',
                'function' => 'linear',
                'operation' => 'multiply',
            ],
            $request->jsonSerialize(),
        );
    }

}
