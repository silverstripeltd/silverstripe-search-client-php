<?php

declare(strict_types=1);

namespace Silverstripe\Search\Client\Request\Curation;

use JsonSerializable;

class CurationDocumentPostRequest implements JsonSerializable
{

    public function __construct(
        private readonly string $documentId,
        private readonly int $type,
        private readonly int $sort,
    ) {
    }

    public function getDocumentId(): string
    {
        return $this->documentId;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getSort(): int
    {
        return $this->sort;
    }

    public function jsonSerialize(): array
    {
        return [
            'document_id' => $this->documentId,
            'type' => $this->type,
            'sort' => $this->sort,
        ];
    }

}
