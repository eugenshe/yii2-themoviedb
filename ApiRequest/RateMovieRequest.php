<?php

/**
 * Class RateMovieRequest
 */
class RateMovieRequest extends MovieRequest
{
    const RATE_MOVIE_URI = '/movie/%s/rating';

    /**
     * @var float
     */
    private $rateValue;

    /**
     * @param $rateValue
     * @return $this
     */
    public function setRateValue($rateValue)
    {
        $this->rateValue = $rateValue;

        return $this;
    }

    /**
     * @return float
     */
    public function getRateValue()
    {
        return $this->rateValue;
    }

    /**
     * @return array
     */
    public function makeRequest()
    {
        $uri = sprintf(self::RATE_MOVIE_URI, $this->getMovieId());
        $sessionId = 'guest_session_id=' . Yii::app()->user->getState('sessionId');
        $this->setRequestParams([$sessionId]);
        $fullUrl = $this->getFullUrl(self::API_URL, $uri);
        $response = $this->getClient()->request(self::METHOD_POST, $fullUrl, [
            'json' => [
                'value'      => $this->getRateValue()
            ]
        ]);

        return $this->arrayResponse($response);
    }
}