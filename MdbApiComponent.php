<?php

use mdbApi\ApiRequest\GuestSessionRequest;
use mdbApi\ApiRequest\DiscoverRequest;
use mdbApi\Session\SessionHandler;

/**
 * Class MdbApiComponent
 */
class MdbApiComponent extends CApplicationComponent
{
    const MDB_API_KEY_NAME   = 'mdbApiKey';
    const MDB_API_KEY_EXPIRE = 'mdbApiKeyExpire';

    /**
     * @var string
     */
    private $apiKey;

    /**
     * Initialyze component
     */
    public function init()
    {
        if (!Yii::app()->user->isGuest) {
            $this->setApiKey(Yii::app()->user->getState('apiKey'));
        }
        parent::init();
    }

    /**
     * @param string $apiKey
     * @return $this
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Validate API Key & save session key
     */
    public function startGuestSession()
    {
        $guest = new GuestSessionRequest();
        $guest->setApiKey($this->apiKey);
        $response = $guest->createSession($guest->makeRequest());

        return $response;
    }

    /**
     * @param string $type
     * @return array
     */
    public function discoverMovies($type = DiscoverRequest::DISCOVER_POPULAR)
    {
        $discover = new DiscoverRequest();
        $discover->setApiKey($this->apiKey);
        $response = $discover
            ->setType($type)
            ->makeRequest();

        return $response;
    }

    /**
     * @param integer $id
     * @return array
     */
    public function movieDetails($id)
    {
        $movie = new MovieRequest();
        $movie->setApiKey($this->apiKey);
        $response = $movie
            ->setMovieId($id)
            ->makeRequest();

        return $response;
    }

    /**
     * @param integer $id
     * @param float   $rateValue
     * @return array
     */
    public function rateMovie($id, $rateValue)
    {
        $movie = new RateMovieRequest();
        $movie->setApiKey($this->apiKey);
        $response = $movie
            ->setMovieId($id)
            ->setRateValue($rateValue)
            ->makeRequest();

        return $response;
    }

    /**
     * @param string $sessionId
     * @return bool
     */
    public function isKeyExpired($sessionId)
    {
        $sessionHandler = new SessionHandler();

        return $sessionHandler->isExpired($sessionId);
    }
}