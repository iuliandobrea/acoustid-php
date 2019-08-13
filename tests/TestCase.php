<?php

namespace Tests;

/**
 * Class TestCase
 *
 * @package Tests
 */
class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * TestCase constructor.
     *
     * @param string|null $name
     * @param array       $data
     * @param string      $dataName
     */
    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }
}