<?php

/**
 * Class MovieRequest
 */
class MovieRequest extends AbstractApiRequest
{
    const MOVIE_URI = '/movie/%s';

    /**
     * @var integer
     */
    private $movieId;

    /**
     * @param $movieId
     * @return $this
     */
    public function setMovieId($movieId)
    {
        $this->movieId = $movieId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getMovieId()
    {
        return $this->movieId;
    }

    /**
     * @return array
     */
    public function makeRequest()
    {
        $uri = sprintf(self::MOVIE_URI, $this->getMovieId());
        $fullUrl = $this->getFullUrl(self::API_URL, $uri);
        $response = $this->getClient()->request(self::METHOD_GET, $fullUrl);

        return $this->arrayResponse($response);
    }
}