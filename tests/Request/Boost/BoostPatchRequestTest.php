<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Tests\Request\Boost;

use PHPUnit\Framework\TestCase;
use Silverstripe\Search\Client\Request\Boost\BoostPatchRequest;
use stdClass;

class BoostPatchRequestTest extends TestCase
{

    public function testDefaultSerializesToEmptyObject(): void
    {
        $request = new BoostPatchRequest();

        $this->assertInstanceOf(stdClass::class, $request->jsonSerialize());
        $this->assertSame('{}', json_encode($request));
    }

    public function testJsonSerializePartial(): void
    {
        $request = new BoostPatchRequest();
        $request->setImpact(3.0);

        $this->assertSame(['impact' => 3.0], $request->jsonSerialize());
    }

    public function testJsonSerializeFull(): void
    {
        $request = new BoostPatchRequest();
        $request->setImpact(2.0);
        $request->setValues(['featured']);
        $request->setCenter('40.7128');
        $request->setFunction('exponential');
        $request->setOperation('add');

        $this->assertSame(
            [
                'impact' => 2.0,
                'values' => ['featured'],
                'center' => '40.7128',
                'function' => 'exponential',
                'operation' => 'add',
            ],
            $request->jsonSerialize(),
        );
    }

}
