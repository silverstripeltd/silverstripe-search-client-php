<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Request\Document;

use JsonSerializable;
use Silverstripe\Search\Client\Model\Pagination;

class DocumentListRequest implements JsonSerializable
{

    private ?Pagination $page = null;

    public function getPage(): ?Pagination
    {
        return $this->page;
    }

    public function setPage(?Pagination $page): static
    {
        $this->page = $page;

        return $this;
    }

    public function jsonSerialize(): array
    {
        $payload = [];

        if ($this->page !== null) {
            $payload['page'] = $this->page;
        }

        return $payload;
    }

}
