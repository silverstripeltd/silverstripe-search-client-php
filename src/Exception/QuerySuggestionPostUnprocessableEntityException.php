<?php

namespace Silverstripe\Search\Client\Exception;

class QuerySuggestionPostUnprocessableEntityException extends UnprocessableEntityException
{
    /**
     * @var \Silverstripe\Search\Client\Model\HTTPValidationError
     */
    private $hTTPValidationError;
    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    private $response;
    public function __construct(\Silverstripe\Search\Client\Model\HTTPValidationError $hTTPValidationError, \Psr\Http\Message\ResponseInterface $response)
    {
        parent::__construct('Validation Error');
        $this->hTTPValidationError = $hTTPValidationError;
        $this->response = $response;
    }
    public function getHTTPValidationError(): \Silverstripe\Search\Client\Model\HTTPValidationError
    {
        return $this->hTTPValidationError;
    }
    public function getResponse(): \Psr\Http\Message\ResponseInterface
    {
        return $this->response;
    }
}