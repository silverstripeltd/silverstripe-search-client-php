<?php

namespace Silverstripe\Search\Client\Model;

class DocumentListResponseMeta
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
     * @var mixed|null
     */
    protected $alerts;
    /**
     * @var PaginationResponse
     */
    protected $page;
    /**
     * @var mixed|null
     */
    protected $requestId;
    /**
     * @var mixed|null
     */
    protected $warnings;
    /**
     * @return mixed
     */
    public function getAlerts()
    {
        return $this->alerts;
    }
    /**
     * @param mixed $alerts
     *
     * @return self
     */
    public function setAlerts($alerts): self
    {
        $this->initialized['alerts'] = true;
        $this->alerts = $alerts;
        return $this;
    }
    /**
     * @return PaginationResponse
     */
    public function getPage(): PaginationResponse
    {
        return $this->page;
    }
    /**
     * @param PaginationResponse $page
     *
     * @return self
     */
    public function setPage(PaginationResponse $page): self
    {
        $this->initialized['page'] = true;
        $this->page = $page;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getRequestId()
    {
        return $this->requestId;
    }
    /**
     * @param mixed $requestId
     *
     * @return self
     */
    public function setRequestId($requestId): self
    {
        $this->initialized['requestId'] = true;
        $this->requestId = $requestId;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getWarnings()
    {
        return $this->warnings;
    }
    /**
     * @param mixed $warnings
     *
     * @return self
     */
    public function setWarnings($warnings): self
    {
        $this->initialized['warnings'] = true;
        $this->warnings = $warnings;
        return $this;
    }
}