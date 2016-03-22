<?php namespace AcoustId\Request;

use AcoustId\ListByMDID;
use AcoustId\Request;

/**
 * Class ListByMBID
 *
 * @package AcoustId\Request
 */
class ListByMBID extends Request
{

    /**
     * ListByMBID constructor.
     *
     * @param ListByMDID $instance
     */
    public function __construct($instance)
    {
        parent::__construct($instance);
    }

    /**
     * Create request url based on $instance
     *
     * @return $this
     */
    public function createRequest()
    {
        # Default raw part for &mbid when array-batch request is set
        $x = '';

        $this->setUrl($this->instance->getUrl());

        $this->params['format'] = $this->instance->getFormat();
        if ($this->params['format'] == 'jsonp') {
            $this->params['jsoncallback'] = $this->instance->getJsonCallBack();
        }

        # Here comes the trick
        $mbid = $this->instance->getMBID();

        # Set several mbids with the same param name
        if (is_array($mbid)) {
            foreach ($mbid as $id) {
                # AcoustId Specific array parameters could be passed as single parameter
                $x .= '&mbid=' . $id;
            }
        }

        # Set single parameter
        if (is_string($mbid)) {
            $this->params['mbid'] = $this->instance->getMBID();
        }

        $this->params['batch'] = $this->instance->getBatch();

        # build query and decode - as we need clear url + set raw part
        $this->setUrl($this->getUrl() . '?' . urldecode(http_build_query($this->params)) . $x);

        return $this;
    }
}