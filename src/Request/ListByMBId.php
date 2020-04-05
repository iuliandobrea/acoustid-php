<?php

namespace AcoustId\Request;

use AcoustId\Request;

/**
 * Class ListByMBId
 *
 * @package AcoustId\Request
 */
class ListByMBId extends Request
{
    /**
     * @var \AcoustId\ListByMBId
     */
    protected $search;

    /**
     * ListByMBId constructor.
     *
     * @param \AcoustId\ListByMBId $instance
     */
    public function __construct(\AcoustId\ListByMBId $instance)
    {
        parent::__construct($instance);

        $this->search     = $instance;
        $classQueryParams = $this->composeQueryParameters();

        $this->createFullQueryString($classQueryParams);
    }

    /**
     * @param \AcoustId\ListByMBId $list
     *
     * @return array
     */
    protected function createBaseQueryStringParameters($list): array
    {
        $query = parent::createBaseQueryStringParameters($list);

        $query['mbid'] = $list->getMBId();

        return $query;
    }

    /**
     * @return array
     */
    protected function composeQueryParameters(): array
    {
        $query = $this->createBaseQueryStringParameters($this->search);

        if ($this->search->getResponseType() == 'jsonp') {
            $query['jsoncallback'] = $this->search->getJsonCallBack();
        }

        return $query;
    }
}
