<?php

namespace Silverstripe\Search\Client\Model;

class CommonModelsCurationDocumentPatchRequestPatchRequest
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
     * Type of curation: 0 = HIDDEN, 1 = PROMOTED
     *
     * @var mixed|null
     */
    protected $type;
    /**
     * @var mixed|null
     */
    protected $sort;
    /**
     * Type of curation: 0 = HIDDEN, 1 = PROMOTED
     *
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * Type of curation: 0 = HIDDEN, 1 = PROMOTED
     *
     * @param mixed $type
     *
     * @return self
     */
    public function setType($type): self
    {
        $this->initialized['type'] = true;
        $this->type = $type;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getSort()
    {
        return $this->sort;
    }
    /**
     * @param mixed $sort
     *
     * @return self
     */
    public function setSort($sort): self
    {
        $this->initialized['sort'] = true;
        $this->sort = $sort;
        return $this;
    }
}