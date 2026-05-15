<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Request\Analytics;

use JsonSerializable;

class ClickRequest implements JsonSerializable
{

    public function __construct(
        private readonly string $requestId,
        private readonly string $documentId,
    ) {
    }

    public function getRequestId(): string
    {
        return $this->requestId;
    }

    public function getDocumentId(): string
    {
        return $this->documentId;
    }

    public function jsonSerialize(): array
    {
        return [
            'request_id' => $this->requestId,
            'document_id' => $this->documentId,
        ];
    }

}
