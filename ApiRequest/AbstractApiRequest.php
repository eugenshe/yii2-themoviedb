<?php

use mdbApi\ApiRequest\ApiRequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class AbstractApiRequest
 */
abstract class AbstractApiRequest implements ApiRequestInterface
{
    const METHOD_GET  = 'GET';
    const METHOD_POST = 'POST';
    const AND_MARK    = '&';
    const API_URL     = 'http://api.themoviedb.org/3';

    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * AbstractApiRequest constructor.
     */
    public function __construct()
    {
        $this->client =  new \GuzzleHttp\Client();
    }

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var array
     */
    private $requestParams = [];

    /**
     * @param string $apiKey
     * @return $this
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param array $requestParams
     * @return $this
     */
    public function setRequestParams(array $requestParams)
    {
        $this->requestParams = $requestParams;

        return $this;
    }

    /**
     * @return array
     */
    public function getRequestParams()
    {
        return $this->requestParams;
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param string $host
     * @param string $uri
     * @return string
     */
    public function getFullUrl($host, $uri)
    {
        $url = sprintf('%s%s?api_key=%s', $host, $uri, $this->getApiKey());
        $params = $this->getRequestParams();
        if ($params) {
            $url .= self::AND_MARK . implode('&', $params);
        }

        return $url;
    }

    /**
     * @param ResponseInterface $response
     * @return array
     */
    public function arrayResponse(ResponseInterface $response)
    {
        return json_decode((string) $response->getBody(), true);
    }

    /**
     * @return array
     */
    abstract public function makeRequest();
}