<?php

namespace Silverstripe\Search\Client\Model;

class Schema extends \ArrayObject
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
    protected $attachment;
    /**
     * @var mixed|null
     */
    protected $body;
    /**
     * @return mixed
     */
    public function getAttachment()
    {
        return $this->attachment;
    }
    /**
     * @param mixed $attachment
     *
     * @return self
     */
    public function setAttachment($attachment): self
    {
        $this->initialized['attachment'] = true;
        $this->attachment = $attachment;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }
    /**
     * @param mixed $body
     *
     * @return self
     */
    public function setBody($body): self
    {
        $this->initialized['body'] = true;
        $this->body = $body;
        return $this;
    }
}