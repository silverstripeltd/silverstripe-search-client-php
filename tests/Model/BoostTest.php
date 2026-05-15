<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Tests\Model;

use PHPUnit\Framework\TestCase;
use Silverstripe\Search\Client\Model\Field\Boost;

class BoostTest extends TestCase
{

    public function testDefaults(): void
    {
        $boost = new Boost('value');

        $this->assertSame('value', $boost->getType());
        $this->assertSame(1.0, $boost->getFactor());
        $this->assertNull($boost->getValue());
        $this->assertNull($boost->getCenter());
        $this->assertNull($boost->getFunction());
        $this->assertNull($boost->getOperation());
    }

    public function testJsonSerializeMinimal(): void
    {
        $boost = new Boost('value');

        $this->assertSame(
            ['type' => 'value', 'factor' => 1.0],
            $boost->jsonSerialize(),
        );
    }

    public function testJsonSerializeFull(): void
    {
        $boost = new Boost('functional');
        $boost->setFactor(2.5);
        $boost->setValue(['premium', 'featured']);
        $boost->setCenter('37.7749');
        $boost->setFunction('linear');
        $boost->setOperation('multiply');

        $this->assertSame(
            [
                'type' => 'functional',
                'factor' => 2.5,
                'value' => ['premium', 'featured'],
                'center' => '37.7749',
                'function' => 'linear',
                'operation' => 'multiply',
            ],
            $boost->jsonSerialize(),
        );
    }

    public function testFluentSetters(): void
    {
        $boost = new Boost('value');
        $result = $boost->setFactor(3.0);

        $this->assertSame($boost, $result);
    }

}
