<?php namespace AcoustId\Request;

use AcoustId\LookUp\FingerPrint;
use AcoustId\LookUp\TrackId;
use AcoustId\Request;

/**
 * Class LookUp
 *
 * @package AcoustId\Request
 */
class LookUp extends Request
{

    /**
     * LookUp constructor.
     *
     * @param FingerPrint|TrackId $instance
     */
    public function __construct($instance)
    {
        parent::__construct($instance);
    }

    /**
     * Create request url based on $lookUp
     *
     * @return $this
     */
    public function createRequest()
    {
        $this->setUrl($this->instance->getUrl());

        $this->params['client'] = $this->instance->getClientId();
        $this->params['format'] = $this->instance->getFormat();
        if ($this->params['format'] == 'jsonp') {
            $this->params['jsoncallback'] = $this->instance->getJsonCallBack();
        }

        if (!empty($this->instance->getMeta())) {
            $this->params['meta'] = join('+', $this->instance->getMeta());
        }

        switch (get_class($this->instance)) {
            # request by fingerPrint
            case FingerPrint::class:
                $this->params['duration']    = $this->instance->getDuration();
                $this->params['fingerprint'] = $this->instance->getFingerPrint();
                break;

            # request by trackId
            case TrackId::class:
                $this->params['trackid'] = $this->instance->getTrackId();
                break;
        }

        # build query and decode - as we need clear url
        $this->setUrl($this->getUrl() . '?' . urldecode(http_build_query($this->params)));

        return $this;
    }
}