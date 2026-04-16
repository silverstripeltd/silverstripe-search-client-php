<?php

namespace Silverstripe\Search\Client\Model;

class ResponseConfirm
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
    protected $message;
    /**
     * @var int
     */
    protected $token;
    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
    /**
     * @param string $message
     *
     * @return self
     */
    public function setMessage(string $message): self
    {
        $this->initialized['message'] = true;
        $this->message = $message;
        return $this;
    }
    /**
     * @return int
     */
    public function getToken(): int
    {
        return $this->token;
    }
    /**
     * @param int $token
     *
     * @return self
     */
    public function setToken(int $token): self
    {
        $this->initialized['token'] = true;
        $this->token = $token;
        return $this;
    }
}