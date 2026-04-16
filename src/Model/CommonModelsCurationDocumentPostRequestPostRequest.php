<?php

namespace Silverstripe\Search\Client\Model;

class CommonModelsCurationDocumentPostRequestPostRequest
{
    /**
     * @var array
     */
    protected $initialized = [];
    public function isInitialized($property): bool
    {
        return array_key_exists($property, $this->initialized);
    }
    /**
     * Document ID cannot be empty or start with whitespace
     *
     * @var string
     */
    protected $documentId;
    /**
     * Type of curation: 0 = HIDDEN, 1 = PROMOTED
     *
     * @var int
     */
    protected $type;
    /**
     * @var int
     */
    protected $sort;
    /**
     * Document ID cannot be empty or start with whitespace
     *
     * @return string
     */
    public function getDocumentId(): string
    {
        return $this->documentId;
    }
    /**
     * Document ID cannot be empty or start with whitespace
     *
     * @param string $documentId
     *
     * @return self
     */
    public function setDocumentId(string $documentId): self
    {
        $this->initialized['documentId'] = true;
        $this->documentId = $documentId;
        return $this;
    }
    /**
     * Type of curation: 0 = HIDDEN, 1 = PROMOTED
     *
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }
    /**
     * Type of curation: 0 = HIDDEN, 1 = PROMOTED
     *
     * @param int $type
     *
     * @return self
     */
    public function setType(int $type): self
    {
        $this->initialized['type'] = true;
        $this->type = $type;
        return $this;
    }
    /**
     * @return int
     */
    public function getSort(): int
    {
        return $this->sort;
    }
    /**
     * @param int $sort
     *
     * @return self
     */
    public function setSort(int $sort): self
    {
        $this->initialized['sort'] = true;
        $this->sort = $sort;
        return $this;
    }
}