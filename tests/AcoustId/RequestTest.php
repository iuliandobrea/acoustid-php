<?php

namespace Tests\AcoustId;

use AcoustId\AcoustId;
use AcoustId\Request;
use Tests\TestCase;

/**
 * Class RequestTest
 *
 * @package Tests\AcoustId
 */
class RequestTest extends TestCase
{
    protected $acoustId;
    protected $instance;

    /**
     * RequestTest constructor.
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
     * @throws \AcoustId\Exceptions\InvalidArgumentException
     */
    protected function setUp(): void
    {
        /** @var AcoustId $acoustId */
        $this->acoustId = new class(getenv('API_APPLICATION_TOKEN')) extends AcoustId {
        };
        $this->acoustId->setAPIUrl('https://api.acoustid.org/v2/lookup');

        /** @var Request instance */
        $this->instance = new class($this->acoustId) extends Request {
            function composeQueryParameters(): array
            {

            }
        };
    }

    /**
     * @throws \AcoustId\Exceptions\AcoustIdException
     * @throws \AcoustId\Exceptions\InvalidArgumentException
     */
    public function testSetOptions(): void
    {
        $this->instance->setOptions(['test' => 123]);
        $this->assertEquals(123, $this->instance->getOptions()['test']);
    }
}
