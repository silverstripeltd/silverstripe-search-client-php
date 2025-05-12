<?php

namespace Silverstripe\Search\Client\Model;

class SynonymRuleRequest extends \ArrayObject
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
    protected $synonyms;
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