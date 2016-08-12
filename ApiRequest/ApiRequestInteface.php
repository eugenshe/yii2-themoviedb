<?php

namespace mdbApi\ApiRequest;

/**
 * Interface ApiRequestInterface
 */
interface ApiRequestInterface
{
    /**
     * @param string $apiKey
     * @return $this
     */
    public function setApiKey($apiKey);

    /**
     * @param array $requestParams
     * @return $this
     */
    public function setRequestParams(array $requestParams);
}