<?php

namespace Silverstripe\Search\Client\Model;

class ClickRequest
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
     * The request_id from the original search response.
     *
     * @var string
     */
    protected $requestId;
    /**
     * The ID of the document that was clicked.
     *
     * @var string
     */
    protected $documentId;
    /**
     * The request_id from the original search response.
     *
     * @return string
     */
    public function getRequestId(): string
    {
        return $this->requestId;
    }
    /**
     * The request_id from the original search response.
     *
     * @param string $requestId
     *
     * @return self
     */
    public function setRequestId(string $requestId): self
    {
        $this->initialized['requestId'] = true;
        $this->requestId = $requestId;
        return $this;
    }
    /**
     * The ID of the document that was clicked.
     *
     * @return string
     */
    public function getDocumentId(): string
    {
        return $this->documentId;
    }
    /**
     * The ID of the document that was clicked.
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
}