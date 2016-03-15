<?php namespace AcoustId\Request\Submission;

use AcoustId\Request;

/**
 * Class Status
 *
 * @package AcoustId\Request\Submission
 */
class Status extends Request
{

    /**
     * Status constructor.
     *
     * @param \AcoustId\Submission\Status $instance
     */
    public function __construct($instance)
    {
        parent::__construct($instance);
    }

    /**
     * Create request url
     *
     * @return $this
     */
    public function createRequest()
    {
        $this->setUrl($this->instance->getUrl());

        $this->params['client']        = $this->instance->getClientId();
        $this->params['format']        = $this->instance->getFormat();
        $this->params['clientversion'] = $this->instance->getClientVersion();
        $this->params['id']            = $this->instance->getId();

        # build query and decode - as we need clear url
        $this->setUrl($this->getUrl() . '?' . urldecode(http_build_query($this->params)));

        return $this;
    }
}