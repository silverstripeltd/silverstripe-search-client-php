<?php

namespace Silverstripe\Search\Client\Model;

class CommonModelsCurationDocumentGetResponseGetResponse
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
     * @var string
     */
    protected $documentId;
    /**
     * @var int
     */
    protected $type;
    /**
     * @var int
     */
    protected $sort;
    /**
     * @return string
     */
    public function getDocumentId(): string
    {
        return $this->documentId;
    }
    /**
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
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }
    /**
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