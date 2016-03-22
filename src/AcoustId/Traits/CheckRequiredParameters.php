<?php namespace AcoustId\Traits;

use AcoustId\Exception;

/**
 * Class CheckRequiredParameters
 *
 * @package AcoustId\Traits
 * @property $requiredParameters
 */
trait CheckRequiredParameters
{
    /**
     * Validate required parameters for any type of look-ups
     *
     * @param array $parameters
     *
     * @return bool
     * @throws Exception
     */
    public function checkRequiredParameters($parameters = ['clientId', 'url'])
    {
        /**
         * In some cases we have a non set property
         */
        if (!isset($this->requiredParameters)) {
            $this->requiredParameters = [];
        }

        foreach ($parameters as $parameter) {
            array_push($this->requiredParameters, $parameter);
        }

        foreach ($this->requiredParameters as $parameter) {
            if (!empty($parameter) && empty($this->{$parameter})) {
                throw new Exception($parameter . ' can\'t be empty.');
            }
        }

        return true;
    }

}