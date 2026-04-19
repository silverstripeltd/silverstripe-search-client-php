<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Tests\Model;

use PHPUnit\Framework\TestCase;
use Silverstripe\Search\Client\Model\Pagination;

class PaginationTest extends TestCase
{

    public function testDefaults(): void
    {
        $pagination = new Pagination();

        $this->assertSame(1, $pagination->getCurrent());
        $this->assertSame(10, $pagination->getSize());
    }

    public function testCustomValues(): void
    {
        $pagination = new Pagination(3, 25);

        $this->assertSame(3, $pagination->getCurrent());
        $this->assertSame(25, $pagination->getSize());
    }

    public function testJsonSerializeDefaults(): void
    {
        $pagination = new Pagination();

        $this->assertSame(
            ['current' => 1, 'size' => 10],
            $pagination->jsonSerialize(),
        );
    }

    public function testJsonSerializeCustomValues(): void
    {
        $pagination = new Pagination(5, 50);

        $this->assertSame(
            ['current' => 5, 'size' => 50],
            $pagination->jsonSerialize(),
        );
    }

}
