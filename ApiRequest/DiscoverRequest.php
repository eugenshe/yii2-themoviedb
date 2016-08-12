<?php

namespace mdbApi\ApiRequest;

use AbstractApiRequest;

/**
 * Class DiscoverRequest
 */
class DiscoverRequest extends AbstractApiRequest
{
    const DISCOVER_URI          = '/discover/movie';
    const DISCOVER_POPULAR      = 'popular';
    const DISCOVER_RELEASE_DATE = 'releaseDate';

    /**
     * @var string
     */
    private $type;

    /**
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function makeRequest()
    {
        switch ($this->getType()) {
            case self::DISCOVER_POPULAR:
                $this->setRequestParams(['sort_by=popularity.desc']);
                break;
            case self::DISCOVER_RELEASE_DATE:
                $timeParameter = 'primary_release_date.gte=' . $this->getReleaseTime();
                $this->setRequestParams([$timeParameter]);
                break;
        }
        $fullUrl = $this->getFullUrl(self::API_URL, self::DISCOVER_URI);
        $response = $this->getClient()->request(self::METHOD_GET, $fullUrl);

        return $this->arrayResponse($response);
    }

    /**
     * @return string
     */
    public function getReleaseTime()
    {
        return date('Y-m-d', strtotime('-2 month'));
    }
}