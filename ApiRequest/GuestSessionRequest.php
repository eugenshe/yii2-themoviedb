<?php

namespace mdbApi\ApiRequest;

use AbstractApiRequest;
use mdbApi\Session\SessionHandler;

/**
 * Class GuestSessionRequest
 * @package mdbApi\ApiRequest
 */
class GuestSessionRequest extends AbstractApiRequest
{
    const GUEST_SESSION_URI = '/authentication/guest_session/new';
    const OK_STATUS_CODE    = 200;
    const GUEST_EXPIRE_KEY  = 'expires_at';
    const GUEST_SESSION_ID  = 'guest_session_id';

    /**
     * @return array
     */
    public function makeRequest()
    {
        $fullUrl = $this->getFullUrl(self::API_URL, self::GUEST_SESSION_URI);
        $response = $this->getClient()->request(self::METHOD_GET, $fullUrl);

        return $this->arrayResponse($response);
    }

    /**
     * @param $response
     * @return string
     */
    public function createSession(array $response)
    {
        $sessionHandler = new SessionHandler();
        $sessionHandler->setSession($this->getApiKey(), $response[self::GUEST_EXPIRE_KEY], $response[self::GUEST_SESSION_ID]);

        return $response[self::GUEST_SESSION_ID];
    }
}