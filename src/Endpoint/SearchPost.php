<?php

namespace Silverstripe\Search\Client\Endpoint;

class SearchPost extends \Silverstripe\Search\Client\Runtime\Client\BaseEndpoint implements \Silverstripe\Search\Client\Runtime\Client\Endpoint
{
    protected $engine_name;
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
    */
    public function __construct(string $engineName, \Silverstripe\Search\Client\Model\SearchRequest $requestBody)
    {
        $this->engine_name = $engineName;
        $this->body = $requestBody;
    }
    use \Silverstripe\Search\Client\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'POST';
    }
    public function getUri(): string
    {
        return str_replace(['{engine_name}'], [$this->engine_name], '/{engine_name}/search');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \Silverstripe\Search\Client\Model\SearchRequest) {
            return [['Content-Type' => ['application/json']], $serializer->serialize($this->body, 'json')];
        }
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    /**
     * {@inheritdoc}
     *
     * @throws \Silverstripe\Search\Client\Exception\SearchPostNotFoundException
     * @throws \Silverstripe\Search\Client\Exception\SearchPostUnprocessableEntityException
     *
     * @return null
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return json_decode($body);
        }
        if (404 === $status) {
            throw new \Silverstripe\Search\Client\Exception\SearchPostNotFoundException($response);
        }
        if (is_null($contentType) === false && (422 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \Silverstripe\Search\Client\Exception\SearchPostUnprocessableEntityException($serializer->deserialize($body, 'Silverstripe\Search\Client\Model\HTTPValidationError', 'json'), $response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['HTTPBearer'];
    }
}