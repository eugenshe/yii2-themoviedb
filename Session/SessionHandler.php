<?php

namespace mdbApi\Session;

use MdbApiComponent;

/**
 * Class SessionHandler
 * @package mdbApi\Session
 */
class SessionHandler implements SessionHandlerInterface
{
    /**
     * @param string $key
     * @param string $expire
     * @param string $sessionId
     * @return $this
     */
    public function setSession($key, $expire, $sessionId)
    {
        $session = [
            MdbApiComponent::MDB_API_KEY_NAME   => $key,
            MdbApiComponent::MDB_API_KEY_EXPIRE => $expire

        ];
        \Yii::app()->session[$sessionId] = $session;

        return $this;
    }

    /**
     * @param string $sessionId
     * @return array
     */
    public function getSession($sessionId)
    {
         return \Yii::app()->session[$sessionId];
    }

    /**
     * @param string $sessionId
     * @return bool
     */
    public function isExpired($sessionId)
    {
        $session = \Yii::app()->session[$sessionId];
        $expireTime = $session[MdbApiComponent::MDB_API_KEY_EXPIRE];

        return time() >= strtotime($expireTime);
    }
}