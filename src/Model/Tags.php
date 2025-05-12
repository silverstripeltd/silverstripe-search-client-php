<?php

namespace Silverstripe\Search\Client\Model;

class Tags extends \ArrayObject
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
    * The Search endpoint can be used to attach tags to your documents. One or more tags can be applied 
           to filter results via the API or within your analytics dashboard.
    *
    * @var list<string>
    */
    protected $tags;
    /**
    * The Search endpoint can be used to attach tags to your documents. One or more tags can be applied 
           to filter results via the API or within your analytics dashboard.
    *
    * @return list<string>
    */
    public function getTags(): array
    {
        return $this->tags;
    }
    /**
    * The Search endpoint can be used to attach tags to your documents. One or more tags can be applied 
           to filter results via the API or within your analytics dashboard.
    *
    * @param list<string> $tags
    *
    * @return self
    */
    public function setTags(array $tags): self
    {
        $this->initialized['tags'] = true;
        $this->tags = $tags;
        return $this;
    }
}