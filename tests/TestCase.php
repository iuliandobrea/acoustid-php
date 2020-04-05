<?php

namespace Tests;

use Psr\Http\Message\ResponseInterface;

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

    /**
     * @param ResponseInterface $response
     */
    protected function isSuccessfulResult(ResponseInterface $response): void
    {
        $this->assertEquals(200, $response->getStatusCode());
        $r = json_decode($response->getBody()->getContents());
        $response->getBody()->rewind();
        $this->assertTrue($r->status === 'ok');
    }
}
