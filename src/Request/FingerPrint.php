<?php

namespace AcoustId\Request;

use AcoustId\Request;

/**
 * Class FingerPrint
 *
 * @package AcoustId\Request
 */
class FingerPrint extends Request
{
    /**
     * @var \AcoustId\LookUp\FingerPrint
     */
    protected $lookUp;

    /**
     * FingerPrint constructor.
     *
     * @param \AcoustId\LookUp\FingerPrint $instance
     */
    public function __construct(\AcoustId\LookUp\FingerPrint $instance)
    {
        parent::__construct($instance);

        $this->lookUp     = $instance;
        $classQueryParams = $this->composeQueryParameters();

        $this->createFullQueryString($classQueryParams);
    }

    /**
     * @param mixed $submission
     *
     * @return array
     */
    protected function createBaseQueryString($submission): array
    {
        $query = parent::createBaseQueryString($submission);

        $query['duration']    = $submission->getDuration();
        $query['fingerprint'] = $submission->getFingerPrint();

        return $query;
    }

    /**
     * @return array
     */
    protected function composeQueryParameters(): array
    {
        $query = $this->createBaseQueryString($this->lookUp);

        if ($this->lookUp->getResponseType() == 'jsonp') {
            $query['jsoncallback'] = $this->lookUp->getJsonCallBack();
        }

        $query['meta'] = join('+', $this->lookUp->getMetaData() ?? $this->lookUp->getMetaDataAllowedValues());

        return $query;
    }
}