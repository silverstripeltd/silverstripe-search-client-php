<?php

namespace Silverstripe\Search\Client;

class Client extends \Silverstripe\Search\Client\Runtime\Client\Client
{
    /**
     * Delete documents by `id`.
     *
     * @param string $engineName 
     * @param array[] $requestBody 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Silverstripe\Search\Client\Exception\DocumentsDeleteNotFoundException
     * @throws \Silverstripe\Search\Client\Exception\DocumentsDeleteUnprocessableEntityException
     *
     * @return null|\Silverstripe\Search\Client\Model\DocumentsDeleteResponse[]|\Psr\Http\Message\ResponseInterface
     */
    public function documentsDelete(string $engineName, array $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Silverstripe\Search\Client\Endpoint\DocumentsDelete($engineName, $requestBody), $fetch);
    }
    /**
    * A paginated array of JSON objects representing documents.
    
    **Query parameters:**
    
    `ids` **(required)**
    * A parameterized query of document `id`. EG: ids=zion_park&ids=does_not_exist
    *
    * @param string $engineName 
    * @param array[] $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Silverstripe\Search\Client\Exception\DocumentsGetNotFoundException
    * @throws \Silverstripe\Search\Client\Exception\DocumentsGetUnprocessableEntityException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function documentsGet(string $engineName, array $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Silverstripe\Search\Client\Endpoint\DocumentsGet($engineName, $requestBody), $fetch);
    }
    /**
    * Update specific document fields by `id` and `field`.
    
    There are a couple of limitations of the PATCH action:
    - The `id` is required and new fields cannot be created using `PATCH`!
    - processing file content is **not supported** via PATCH
    *
    * @param string $engineName 
    * @param array[] $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Silverstripe\Search\Client\Exception\DocumentsPatchNotFoundException
    * @throws \Silverstripe\Search\Client\Exception\DocumentsPatchUnprocessableEntityException
    *
    * @return null|\Silverstripe\Search\Client\Model\DocumentPostPatchResponse[]|\Psr\Http\Message\ResponseInterface
    */
    public function documentsPatch(string $engineName, array $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Silverstripe\Search\Client\Endpoint\DocumentsPatch($engineName, $requestBody), $fetch);
    }
    /**
    * Create or update documents.
    
    Documents are indexed asynchronously. There will be a processing delay before they are available to your Engine.
    
    **Key points to remember when creating documents:**
    
    * It is recommended that you provide your own `id` field, but If no `id` is provided, a unique `id` will be
     generated.
    * A new document is created each time content is received without an `id` - beware duplicates!
    * A document will be updated - not created - if its `id` already exists within a document.
    
    **Processing file contents**
    
    * An `_attachment` field can be used to attach PDF and Docx files to your document.
    * The _attachment` field should contain a base 64 encoded string of binary.
    *
    * @param string $engineName 
    * @param array[] $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Silverstripe\Search\Client\Exception\DocumentsPostNotFoundException
    * @throws \Silverstripe\Search\Client\Exception\DocumentsPostUnprocessableEntityException
    *
    * @return null|\Silverstripe\Search\Client\Model\DocumentPostPatchResponse[]|\Psr\Http\Message\ResponseInterface
    */
    public function documentsPost(string $engineName, array $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Silverstripe\Search\Client\Endpoint\DocumentsPost($engineName, $requestBody), $fetch);
    }
    /**
    * **Body:**
    
    `page` (optional)
    * Object to delimit the pagination parameters.
    
    `page.size` (optional)
    * Number of results per page.
    * Must be greater than or equal to 1 and less than or equal to 100.
    * Defaults to 10.
    
    `page.current` (optional)
    * Page number of results to return.
    * Must be greater than or equal to 1 and less than or equal to 100.
    * Defaults to 1.
    *
    * @param string $engineName 
    * @param \Silverstripe\Search\Client\Model\DocumentListRequest $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Silverstripe\Search\Client\Exception\DocumentsListPostNotFoundException
    * @throws \Silverstripe\Search\Client\Exception\DocumentsListPostUnprocessableEntityException
    *
    * @return null|\Silverstripe\Search\Client\Model\DocumentListResponse|\Psr\Http\Message\ResponseInterface
    */
    public function documentsListPost(string $engineName, \Silverstripe\Search\Client\Model\DocumentListRequest $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Silverstripe\Search\Client\Endpoint\DocumentsListPost($engineName, $requestBody), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Silverstripe\Search\Client\Exception\EnginesPostNotFoundException
     *
     * @return null|\Silverstripe\Search\Client\Model\EnginesResponse|\Psr\Http\Message\ResponseInterface
     */
    public function enginesPost(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Silverstripe\Search\Client\Endpoint\EnginesPost(), $fetch);
    }
    /**
    * Provide relevant query suggestions for incomplete queries. Also known as Autocomplete.
    
    Only available on text fields.
    
    **Body:**
    
    `query` **(required)**
    * A partial query for which to receive suggestions.
    
    `types` (optional)
    * Specify the documents key within the types parameter to look for suggestions within certain text fields. Defaults to all text fields.
    
    `size` (optional)
    * Number of query suggestions to return. Must be between 1 and 20. Defaults to 10.
    *
    * @param string $engineName 
    * @param \Silverstripe\Search\Client\Model\QuerySuggestionRequest $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Silverstripe\Search\Client\Exception\QuerySuggestionPostNotFoundException
    * @throws \Silverstripe\Search\Client\Exception\QuerySuggestionPostUnprocessableEntityException
    *
    * @return null|\Silverstripe\Search\Client\Model\QuerySuggestionResponse|\Psr\Http\Message\ResponseInterface
    */
    public function querySuggestionPost(string $engineName, \Silverstripe\Search\Client\Model\QuerySuggestionRequest $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Silverstripe\Search\Client\Endpoint\QuerySuggestionPost($engineName, $requestBody), $fetch);
    }
    /**
     * 
     *
     * @param string $engineName 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Silverstripe\Search\Client\Exception\SchemaGetNotFoundException
     * @throws \Silverstripe\Search\Client\Exception\SchemaGetUnprocessableEntityException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function schemaGet(string $engineName, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Silverstripe\Search\Client\Endpoint\SchemaGet($engineName), $fetch);
    }
    /**
    * **Field types:**
    
    * `text`
    * `number`
    * `date`
       * Strings containing formatted dates, e.g. "2015-01-01" or "2015/01/01 12:10:30".
       * A number representing seconds-since-the-epoch.
    * `geolocation`
    
    **Field names:**
    
    * Must contain a lowercase letter and may only contain lowercase letters, numbers, and underscores.
    * Must not contain whitespace or have a leading underscore.
    * Must not contain more than 64 characters.
    * Must not be any of the following reserved words:
       * `id`
       * `engine_id`
       * `search_index_id`
       * `highlight`
       * `any`
       * `all`
       * `none`
       * `or`
       * `and`
       * `not`
    * The following fields can be used, but must be of type `text`
       * `body`
    * The following fields can be used, but must be of type `binary`
       * `_attachment`
    *
    * @param string $engineName 
    * @param \stdClass $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Silverstripe\Search\Client\Exception\SchemaPostNotFoundException
    * @throws \Silverstripe\Search\Client\Exception\SchemaPostUnprocessableEntityException
    *
    * @return null|\Silverstripe\Search\Client\Model\SchemaPostResponse|\Psr\Http\Message\ResponseInterface
    */
    public function schemaPost(string $engineName, \stdClass $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Silverstripe\Search\Client\Endpoint\SchemaPost($engineName, $requestBody), $fetch);
    }
    /**
    * Submit a search and receive a set of results with metadata.
    
    **Body:**
    
    `query` **(required)**
    * String or number to match
    * The value '' (empty string) matches all documents
    * The following Lucene query syntax is supported:
       * double-quoted strings
       * `+` and `-`
       * `AND` and `NOT`
    
    `page` (optional)
    * Object to delimit the pagination parameters.
    
    `page.size` (optional)
    * Number of results per page
    * Must be greater than or equal to 1 and less than or equal to 100
    * Defaults to 10.
    
    `page.current` (optional)
    * Page number of results to return
    * Must be greater than or equal to 1 and less than or equal to 100
    * Defaults to 1.
    
    `sort` (optional)
    * Sort your results in an order other than document score
    * JSON object where the key is the field you wish to sort on, and the value is `asc` or `desc`
    * Multiple keys/value pairs can be provided if you wish to sort against multiple fields
    * The following sorting options are available based on field type:
       * `text`: Alphanumerically, case-sensitive
       * `number`: Numerically
       * `date`: Historically
       * `geolocation`: By distance to a provided geographical point.
    
    `facets` (optional)
    * Create value and range facets
    * The facets key opens up the object where you define your facet field
    * The following facet types are available based on field type:
       * `text`: Value facet
       * `number`: Value facet, Range facet
       * `date`: Value facet, Range facet
       * `geolocation`: Currently unsupported
    
    `facets.{field_key}` **(required)**
    * The field from your schema that you which to apply your facet to.
    
    `facets.{field_key}.type` **(required)**
    * The type of facet to use. Must be one of "value" or "range".
    
    `facets.{field_key}.name` (optional)
    * Custom name given to the facet that is used for your results.
    
    `facets.{field_key}.size` (optional)
    * Only valid for "value" type facets
    * How many facets would you like to return?
    * Can be between 1 and 100
    * Defaults to 10.
    
    `facets.{field_key}.sort` (optional)
    * Only valid for "value" type facets
    * JSON object where the key is either `count` or `value` and the value is `asc` or `desc`
    * Defaults to descending `count`.
    
    `facets.{field_key}.ranges` (required for "range" type facets)
    * Only valid for "range" type facets
    * An array of range objects (JSON objects). Each range object can include:
       * `from`: A value to select from (inclusive of the value defined). Required if no "to" value is provided
       * `to`: A value to select to (exclusive of the value defined). Required if no "from" value is provided
       * `name`: A name given to the range (optional)
    
    `filters` (optional)
    * Apply conditions to field values to filter results
    * The following filters are available based on field type:
       * `text`: Value filter
       * `number`: Value filter, Range filter
       * `date`: Value filter, Range filter
       * `geolocation`: Geo filter
    
    `search_fields` (optional)
    * The search_fields parameter restricts a query to search only specific fields
    * Restricting fields will result in faster queries, especially for schemas with many text fields
    * Only available within text fields.
    
    `search_field.{field_key}` **(required)**
    * {field_key} must be a valid field in your documents, the value should be a json object with an (optional) `weight`
     key/value (see below)
    
    `search_field.{field_key}.weight` (optional)
    * Weight is given between 10 (most relevant) to 1 (least relevant). You can also set weight to 0 to make the field
     unsearchable at query time.
    
    `result_fields` (optional)
    * Change the fields which appear in search results and how their values are rendered
    * **Note:** `id` is a special case. It will always return within the `raw` object, and it ignores any requests for
     `size` or `snippet`
    
    `result_fields.{field_key}` (optional)
    * {field_key} must be a valid field in your documents, the value should be a json object with an (optional) `raw`
     and/or `snippet` keys (see below)
    
    `result_fields.{field_key}.raw` (optional)
    * An exact representation of the value within a field. And it is exact! It is not HTML escaped
    * A json object with an optional `size` key (see below).
    
    `result_fields.{field_key}.raw.size` (optional)
    * Length of the return value. Only can be used on text fields
    * Must be at least 20
    * Defaults to the entire text field
    * If given for a different field type other than text, it will be silently ignored.
    
    `result_fields.{field_key}.snippet` (optional)
    * The query match will be wrapped in `<em></em>` tags, for highlighting, if a match exists
    * A json object with optional `size` and `fallback` keys (see below)
    
    `result_fields.{field_key}.snippet.size` (optional)
    * Character length of the snippet returned
    * Must be at least 20
    * Defaults to 100.
    
    `result_fields.{field_key}.snippet.fallback` (optional)
    * If true, return the raw text field if no snippet is found. If false, only use snippets.
    
    `analytics` (optional)
    * Object to delimit the analytics parameters.
    
    `analytics.tags` **(required)**
    * Array of strings representing the tags you’d like to apply to the query
    * You may submit up to 16 tags, and each may be up to 64 characters in length.
    
    `record_analytics` (optional)
    * If `true`, generates an analytics query event for the search request
    * Defaults to `true`.
    *
    * @param string $engineName 
    * @param \Silverstripe\Search\Client\Model\SearchRequest $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Silverstripe\Search\Client\Exception\SearchPostNotFoundException
    * @throws \Silverstripe\Search\Client\Exception\SearchPostUnprocessableEntityException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function searchPost(string $engineName, \Silverstripe\Search\Client\Model\SearchRequest $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Silverstripe\Search\Client\Endpoint\SearchPost($engineName, $requestBody), $fetch);
    }
    /**
    * Provide relevant spelling suggestions for queries. Not to be confused with autocomplete.
    
    Only available on text fields.
    
    **Body:**
    
    `query` **(required)**
    * A query for which to receive spelling suggestions.
    
    `fields` **(required)**
    * Specify the fields within your documents that you would like spelling suggestions from. At least one field is
     required.
    
    `size` (optional)
    * Number of spelling suggestions to return. Must be between 1 and 10. Defaults to 1.
    *
    * @param string $engineName 
    * @param \Silverstripe\Search\Client\Model\SpellingSuggestionRequest $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Silverstripe\Search\Client\Exception\SpellingSuggestionPostNotFoundException
    * @throws \Silverstripe\Search\Client\Exception\SpellingSuggestionPostUnprocessableEntityException
    *
    * @return null|\Silverstripe\Search\Client\Model\SpellingSuggestionResponse|\Psr\Http\Message\ResponseInterface
    */
    public function spellingSuggestionPost(string $engineName, \Silverstripe\Search\Client\Model\SpellingSuggestionRequest $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Silverstripe\Search\Client\Endpoint\SpellingSuggestionPost($engineName, $requestBody), $fetch);
    }
    /**
     * Retrieve all synonyms for a particular engine.
     *
     * @param string $engineName 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Silverstripe\Search\Client\Exception\SynonymRulesGetNotFoundException
     * @throws \Silverstripe\Search\Client\Exception\SynonymRulesGetUnprocessableEntityException
     *
     * @return null|\Silverstripe\Search\Client\Model\SynonymRule[]|\Psr\Http\Message\ResponseInterface
     */
    public function synonymRulesGet(string $engineName, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Silverstripe\Search\Client\Endpoint\SynonymRulesGet($engineName), $fetch);
    }
    /**
    * The POST method will automatically generate an ID for your synonym.
    
    Our synonym format supports two styles of definition:
    
    * Equivalent synonyms: Groups of words, where any word in the group is a valid replacement. Example:
       * "ipod, i-pod, i pod"
       * "computer, pc, laptop"
    * Explicit synonyms: Groups of words that are replaced by a second group of words. IE words on the left are replaced
     (and expanded) into the words on the right. Example:
       * "pc => personal computer"
       * "js => javascript, es6"
       * "sea biscuit, sea biscit => seabiscuit"
    * A maximum of 32 words can be added to a synonym
    *
    * @param string $engineName 
    * @param \Silverstripe\Search\Client\Model\SynonymRuleRequest $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Silverstripe\Search\Client\Exception\SynonymRulePostNotFoundException
    * @throws \Silverstripe\Search\Client\Exception\SynonymRulePostUnprocessableEntityException
    *
    * @return null|\Silverstripe\Search\Client\Model\SynonymRule|\Psr\Http\Message\ResponseInterface
    */
    public function synonymRulePost(string $engineName, \Silverstripe\Search\Client\Model\SynonymRuleRequest $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Silverstripe\Search\Client\Endpoint\SynonymRulePost($engineName, $requestBody), $fetch);
    }
    /**
     * Delete an existing synonym value by its ID.
     *
     * @param string $ruleId 
     * @param string $engineName 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Silverstripe\Search\Client\Exception\SynonymRuleDeleteNotFoundException
     * @throws \Silverstripe\Search\Client\Exception\SynonymRuleDeleteUnprocessableEntityException
     *
     * @return null|\Silverstripe\Search\Client\Model\ResponseSuccess|\Psr\Http\Message\ResponseInterface
     */
    public function synonymRuleDelete(string $ruleId, string $engineName, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Silverstripe\Search\Client\Endpoint\SynonymRuleDelete($ruleId, $engineName), $fetch);
    }
    /**
     * Retrieve a specific synonym by its ID.
     *
     * @param string $ruleId 
     * @param string $engineName 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \Silverstripe\Search\Client\Exception\SynonymRuleGetNotFoundException
     * @throws \Silverstripe\Search\Client\Exception\SynonymRuleGetUnprocessableEntityException
     *
     * @return null|\Silverstripe\Search\Client\Model\SynonymRule|\Psr\Http\Message\ResponseInterface
     */
    public function synonymRuleGet(string $ruleId, string $engineName, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Silverstripe\Search\Client\Endpoint\SynonymRuleGet($ruleId, $engineName), $fetch);
    }
    /**
    * Create or update an existing synonym.
    
    Our synonym value format supports two styles of definition:
    
    * Equivalent synonyms: Groups of words, where any word in the group is a valid replacement. Example:
       * "ipod, i-pod, i pod"
       * "computer, pc, laptop"
    * Explicit synonyms: Groups of words that are replaced by a second group of words. IE words on the left are replaced
     (and expanded) into the words on the right. Example:
       * "pc => personal computer"
       * "js => javascript, es6"
       * "sea biscuit, sea biscit => seabiscuit"
    * A maximum of 32 words can be added to a synonym
    *
    * @param string $ruleId 
    * @param string $engineName 
    * @param \Silverstripe\Search\Client\Model\SynonymRuleRequest $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \Silverstripe\Search\Client\Exception\SynonymRulePutNotFoundException
    * @throws \Silverstripe\Search\Client\Exception\SynonymRulePutUnprocessableEntityException
    *
    * @return null|\Silverstripe\Search\Client\Model\SynonymRule|\Psr\Http\Message\ResponseInterface
    */
    public function synonymRulePut(string $ruleId, string $engineName, \Silverstripe\Search\Client\Model\SynonymRuleRequest $requestBody, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \Silverstripe\Search\Client\Endpoint\SynonymRulePut($ruleId, $engineName, $requestBody), $fetch);
    }
    public static function create($httpClient = null, array $additionalPlugins = [], array $additionalNormalizers = [])
    {
        if (null === $httpClient) {
            $httpClient = \Http\Discovery\Psr18ClientDiscovery::find();
            $plugins = [];
            $uri = \Http\Discovery\Psr17FactoryDiscovery::findUriFactory()->createUri('/api/v1');
            $plugins[] = new \Http\Client\Common\Plugin\AddPathPlugin($uri);
            if (count($additionalPlugins) > 0) {
                $plugins = array_merge($plugins, $additionalPlugins);
            }
            $httpClient = new \Http\Client\Common\PluginClient($httpClient, $plugins);
        }
        $requestFactory = \Http\Discovery\Psr17FactoryDiscovery::findRequestFactory();
        $streamFactory = \Http\Discovery\Psr17FactoryDiscovery::findStreamFactory();
        $normalizers = [new \Symfony\Component\Serializer\Normalizer\ArrayDenormalizer(), new \Silverstripe\Search\Client\Normalizer\JaneObjectNormalizer()];
        if (count($additionalNormalizers) > 0) {
            $normalizers = array_merge($normalizers, $additionalNormalizers);
        }
        $serializer = new \Symfony\Component\Serializer\Serializer($normalizers, [new \Symfony\Component\Serializer\Encoder\JsonEncoder(new \Symfony\Component\Serializer\Encoder\JsonEncode(), new \Symfony\Component\Serializer\Encoder\JsonDecode(['json_decode_associative' => true]))]);
        return new static($httpClient, $requestFactory, $serializer, $streamFactory);
    }
}