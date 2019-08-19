<?php

namespace Tests\Submission;

use AcoustId\Exceptions\BadMethodCallException;
use AcoustId\Exceptions\InvalidArgumentException;
use AcoustId\Submission\Status;
use Tests\TestCase;

/**
 * Class StatusTest
 *
 * @package Tests\Submission
 */
class StatusTest extends TestCase
{
    /**
     * @var Status
     */
    protected $instance;

    /**
     * StatusTest constructor.
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
     *
     */
    protected function setUp()
    {
        $this->instance = new class(getenv('API_APPLICATION_TOKEN')) extends Status
        {
        };
    }

    /**
     * @throws BadMethodCallException
     */
    public function testSetJSONPResponseType()
    {
        $this->expectException(BadMethodCallException::class);
        $this->instance->setJSONPResponseType('test');
    }

    /**
     * @covers \AcoustId\Submission\Status::setSubmissionId
     * @covers \AcoustId\Submission\Status::getSubmissionId
     */
    public function testSetSubmissionId()
    {
        $this->instance->setSubmissionId(485753422);
        $this->assertEquals(485753422, $this->instance->getSubmissionId());

        $this->expectException(InvalidArgumentException::class);
        $this->instance->setSubmissionId(-1);
    }

    /**
     * @throws InvalidArgumentException
     * @throws \AcoustId\Exceptions\HttpException
     * @throws \AcoustId\Exceptions\UnexpectedValueException
     * @covers \AcoustId\Submission\Status::find
     */
    public function testSearch()
    {
        $result = $this->instance->find(485753422);
        $this->assertEquals('ok', json_decode($result->getBody()->getContents())->status);
        $this->assertEquals(200, $result->getStatusCode());

        $this->instance->setSubmissionId(485753422);
        $result = $this->instance->find();
        $this->assertEquals('ok', json_decode($result->getBody()->getContents())->status);
        $this->assertEquals(200, $result->getStatusCode());
    }
}
