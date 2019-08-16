<?php

namespace AcoustId\Request;

use AcoustId\Request;

/**
 * Class TrackId
 *
 * @package AcoustId\Request
 */
class TrackId extends Request
{
    /**
     * @var \AcoustId\LookUp\TrackId
     */
    protected $lookUp;

    /**
     * TrackId constructor.
     *
     * @param \AcoustId\LookUp\TrackId $instance
     */
    public function __construct(\AcoustId\LookUp\TrackId $instance)
    {
        parent::__construct($instance);

        $this->lookUp     = $instance;
        $classQueryParams = $this->composeQueryParameters();

        $this->createFullQueryString($classQueryParams);
    }

    /**
     * @return array
     */
    protected function composeQueryParameters(): array
    {
        $query            = $this->createBaseQueryString($this->lookUp);
        $query['trackid'] = $this->lookUp->getTrackId();

        if ($this->lookUp->getResponseType() == 'jsonp') {
            $query['jsoncallback'] = $this->lookUp->getJsonCallBack();
        }

        $query['meta'] = join('+', $this->lookUp->getMetaData() ?? $this->lookUp->getMetaDataAllowedValues());

        return $query;
    }
}