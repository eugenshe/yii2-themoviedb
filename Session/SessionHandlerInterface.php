<?php

namespace mdbApi\Session;

/**
 * Interface SessionHandlerInterface
 */
interface SessionHandlerInterface
{
    /**
     * @param string $key
     * @param string $expire
     * @param string $sessionId
     * @return $this
     */
    public function setSession($key, $expire, $sessionId);

    /**
     * @param string $sessionId
     * @return array
     */
    public function getSession($sessionId);

    /**
     * @param string $sessionId
     * @return bool
     */
    public function isExpired($sessionId);
}