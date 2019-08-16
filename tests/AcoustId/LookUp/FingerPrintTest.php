<?php

namespace Tests\AcoustId;

use AcoustId\Exceptions\HttpException;
use AcoustId\Exceptions\InvalidArgumentException;
use AcoustId\LookUp\FingerPrint;
use Psr\Http\Message\ResponseInterface;
use Tests\TestCase;

/**
 * Class FingerPrintTest
 *
 * @package Tests\AcoustId
 */
class FingerPrintTest extends TestCase
{
    /**
     * @var FingerPrint
     */
    protected $instance;

    /**
     * FingerPrintTest constructor.
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
        $this->instance = new class(getenv('API_APPLICATION_TOKEN')) extends FingerPrint
        {
        };

        $this->fp = 'AQABz0qUkZK4oOfhL-CPc4e5C_wW2H2QH9uDL4cvoT8UNQ-eHtsE8cceeFJx-LiiHT-aPzhxoc-Opj_eI5d2hOFyMJRzfDk-QSsu7fBxqZDMHcfxPfDIoPWxv9C1o3yg44d_3Df2GJaUQeeR-cb2HfaPNsdxHj2PJnpwPMN3aPcEMzd-_MeB_Ej4D_CLP8ghHjkJv_jh_UDuQ8xnILwunPg6hF2R8HgzvLhxHVYP_ziJX0eKPnIE1UePMByDJyg7wz_6yELsB8n4oDmDa0Gv40hf6D3CE3_wH6HFaxCPUD9-hNeF5MfWEP3SCGym4-SxnXiGs0mRjEXD6fgl4LmKWrSChzzC33ge9PB3otyJMk-IVC6R8MTNwD9qKQ_CC8kPv4THzEGZS8GPI3x0iGVUxC1hRSizC5VzoamYDi-uR7iKPhGSI82PkiWeB_eHijvsaIWfBCWH5AjjCfVxZ1TQ3CvCTclGnEMfHbnZFA8pjD6KXwd__Cn-Y8e_I9cq6CR-4S9KLXqQcsxxoWh3eMxiHI6TIzyPv0M43YHz4yte-Cv-4D16Hv9F9C9SPUdyGtZRHV-OHEeeGD--BKcjVLOK_NCDXMfx44dzHEiOZ0Z44Rf6DH5R3uiPj4d_PKolJNyRJzyu4_CTD2WOvzjKH9GPb4cUP1Av9EuQd8fGCFee4JlRHi18xQh96NLxkCgfWFKOH6WGeoe4I3za4c5hTscTPEZTES1x8kE-9MQPjT8a8gh5fPgQZtqCFj9MDvp6fDx6NCd07bjx7MLR9AhtnFnQ70GjOcV0opmm4zpY3SOa7HiwdTtyHa6NC4e-HN-OfC5-OP_gLe2QDxfUCz_0w9l65HiPAz9-IaGOUA7-4MZ5CWFOlIfe4yUa6AiZGxf6w0fFxsjTOdC6Itbh4mGD63iPH9-RFy909XAMj7mC5_BvlDyO6kGTZKJxHUd4NDwuZUffw_5RMsde5CWkJAgXnDReNEaP6DTOQ65yaD88HoeX8fge-DSeHo9Qa8cTHc80I-_RoHxx_UHeBxrJw62Q34Kd7MEfpCcu6BLeB1ePw6OO4sOF_sHhmB504WWDZiEu8sKPpkcfCT9xfej0o0lr4T5yNJeOvjmu40w-TDmqHXmYgfFhFy_M7tD1o0cO_B2ms2j-ACEEQgQgAIwzTgAGmBIKIImNQAABwgQATAlhDGCCEIGIIM4BaBgwQBogEBIOESEIA8ARI5xAhxEFmAGAMCKAURKQQpQzRAAkCCBQEAKkQYIYIQQxCixCDADCABMAE0gpJIgyxhEDiCKCCIGAEIgJIQByAhFgGACCACMRQEyBAoxQiHiCBCFOECQFAIgAABR2QAgFjCDMA0AUMIoAIMChQghChASGEGeYEAIAIhgBSErnJPPEGWYAMgw05AhiiGHiBBBGGSCQcQgwRYJwhDDhgCSCSSEIQYwILoyAjAIigBFEUQK8gAYAQ5BCAAjkjCCAEEMZAUQAZQCjCCkpCgFMCCiIcVIAZZgilAQAiSHQECOcQAQIc4QClAHAjDDGkAGAMUoBgyhihgEChFCAAWEIEYwIJYwViAAlHCBIGEIEAEIQAoBwwgwiEBAEEEOoEwBY4wRwxAhBgAcKAESIQAwwIowRFhoBhAE';
        $this->d  = 641;
    }

    /**
     * @throws \AcoustId\Exceptions\InvalidArgumentException
     * @covers \AcoustId\LookUp\FingerPrint::setDuration
     * @covers \AcoustId\LookUp\FingerPrint::getDuration
     */
    public function testSetDuration()
    {
        $this->instance->setDuration($this->d);
        $this->assertEquals($this->d, $this->instance->getDuration());

        $this->expectException(InvalidArgumentException::class);
        $this->instance->setDuration(-1);
    }

    /**
     * @throws \AcoustId\Exceptions\InvalidArgumentException
     * @covers \AcoustId\LookUp\FingerPrint::setFingerPrint
     * @covers \AcoustId\LookUp\FingerPrint::getFingerPrint
     */
    public function testSetFingerPrint()
    {
        $this->instance->setFingerPrint($this->fp);
        $this->assertEquals($this->fp, $this->instance->getFingerPrint());
    }

    /**
     * @throws HttpException
     * @throws InvalidArgumentException
     * @covers \AcoustId\LookUp\FingerPrint::lookUp
     */
    public function testLookUpBadClientId()
    {
        $this->expectException(HttpException::class);
        $this->instance->lookUp(1, 'fp');
    }

    /**
     * @throws HttpException
     * @throws InvalidArgumentException
     * @throws \AcoustId\Exceptions\UnexpectedValueException
     * @covers \AcoustId\LookUp\FingerPrint::lookUp
     */
    public function testLookUp()
    {
        $fp = new FingerPrint(getenv('API_APPLICATION_TOKEN'));
        $this->assertInstanceOf(ResponseInterface::class, ($result = $fp->lookUp($this->d, $this->fp)));
        $result = json_decode($result->getBody()->getContents());
        $this->assertTrue($result->status == 'ok');
        $this->assertTrue(!empty($result->results));
    }

    /**
     * @throws HttpException
     * @throws InvalidArgumentException
     * @throws \AcoustId\Exceptions\UnexpectedValueException
     */
    public function testLookUpMeta()
    {
        $fp = new FingerPrint(getenv('API_APPLICATION_TOKEN'));
        $this->assertInstanceOf(ResponseInterface::class, ($result = $fp->setMetaData(['recordings', 'releasegroups', 'compress'])->lookUp($this->d, $this->fp)));
        $result = json_decode($result->getBody()->getContents());
        $this->assertTrue($result->status == 'ok');
        $this->assertTrue(!empty($result->results));
        $this->assertTrue(!empty($result->results[0]->recordings));
    }
}