<?php

namespace Silverstripe\Search\Client\Model;

class ValidationError extends \ArrayObject
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
     * 
     *
     * @var list<mixed>
     */
    protected $loc;
    /**
     * 
     *
     * @var string
     */
    protected $msg;
    /**
     * 
     *
     * @var string
     */
    protected $type;
    /**
     * 
     *
     * @return list<mixed>
     */
    public function getLoc(): array
    {
        return $this->loc;
    }
    /**
     * 
     *
     * @param list<mixed> $loc
     *
     * @return self
     */
    public function setLoc(array $loc): self
    {
        $this->initialized['loc'] = true;
        $this->loc = $loc;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getMsg(): string
    {
        return $this->msg;
    }
    /**
     * 
     *
     * @param string $msg
     *
     * @return self
     */
    public function setMsg(string $msg): self
    {
        $this->initialized['msg'] = true;
        $this->msg = $msg;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
    /**
     * 
     *
     * @param string $type
     *
     * @return self
     */
    public function setType(string $type): self
    {
        $this->initialized['type'] = true;
        $this->type = $type;
        return $this;
    }
}