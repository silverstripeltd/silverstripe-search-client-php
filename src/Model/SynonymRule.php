<?php

namespace Silverstripe\Search\Client\Model;

class SynonymRule extends \ArrayObject
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
     * @var string
     */
    protected $id;
    /**
     * 
     *
     * @var string
     */
    protected $synonyms;
    /**
     * 
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
    /**
     * 
     *
     * @param string $id
     *
     * @return self
     */
    public function setId(string $id): self
    {
        $this->initialized['id'] = true;
        $this->id = $id;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getSynonyms(): string
    {
        return $this->synonyms;
    }
    /**
     * 
     *
     * @param string $synonyms
     *
     * @return self
     */
    public function setSynonyms(string $synonyms): self
    {
        $this->initialized['synonyms'] = true;
        $this->synonyms = $synonyms;
        return $this;
    }
}