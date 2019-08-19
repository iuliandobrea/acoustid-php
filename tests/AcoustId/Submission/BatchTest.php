<?php

namespace Tests\Submission;

use AcoustId\Exceptions\BadMethodCallException;
use AcoustId\Submission;
use AcoustId\Submission\Batch;
use Tests\TestCase;

/**
 * Class BatchTest
 *
 * @package Tests\Submission
 */
class BatchTest extends TestCase
{
    /**
     * @var Batch
     */
    protected $instance;

    /**
     * BatchTest constructor.
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
        $this->instance = new class(getenv('API_APPLICATION_TOKEN')) extends Batch
        {
        };
    }

    /**
     * @covers \AcoustId\Submission\Batch::send
     */
    public function testSend()
    {
        $this->expectException(BadMethodCallException::class);
        $this->instance->send();
    }

    /**
     * @throws \AcoustId\Exceptions\InvalidArgumentException
     * @throws \AcoustId\Exceptions\UnexpectedValueException
     * @covers \AcoustId\Submission\Batch::appendToBatch
     * @covers \AcoustId\Submission\Batch::getBatch
     */
    public function testAppendToBatch()
    {
        $this->instance->appendToBatch(
            (new Submission($this->instance->getClientAPIToken()))->setFingerPrint('test')->setDuration(100)
        );

        $this->assertTrue(is_array($this->instance->getBatch()));
        $this->assertTrue(!empty($this->instance->getBatch()));

        $this->assertEquals('test', $this->instance->getBatch()[0]->getFingerPrint());
        $this->assertEquals(100, $this->instance->getBatch()[0]->getDuration());
    }

    /**
     * @throws \AcoustId\Exceptions\InvalidArgumentException
     * @throws \AcoustId\Exceptions\UnexpectedValueException
     * @throws \AcoustId\Exceptions\HttpException
     * @covers \AcoustId\Submission\Batch::sendBatch
     */
    public function testSendBatch()
    {
        $this->instance->setUserToken(getenv('API_USER_TOKEN'));

        $result = $this->instance->sendBatch([
            (new \AcoustId\Submission($this->instance->getClientAPIToken()))
                ->setFingerPrint('AQADtF8SZUkSRZjyzEMoM9ClnCAlPriOklngXEepbfiFKzweKabQ5MYZCrWJD82PngjdoPmDO0eeCzWaH0_xzkInH96FI2eGcJE9fDlqXfCPN5Bv3Ic-I8-Ot4Mj-Wh5HE09I8TdE9okzUKaIy8LnymRH56UfUKtHfFR3hDdFN9y5McZ4s_hUEe7HHl4NPUBPXgO89D7wT7OJYaoGV8uXPA9nCk-7tB7xFcCixdxXqgW9Dl-CimuQ8yOjp7Q5IbWZYf6Exo9o3mK_BPKC36OK8vxD2-OUqKHeNOhLS-aGKyUI7-Q9xF-aHlChIqGH6dS9MwJV_px_MiiuEiqrsX1CI2PGh8uXOeGZjl6IUyuC9p73G2KxjseXgmu4T_EB9RpDaH_4CvmZMc_-MiP64JOC80VlBKPaiesa_gI19BWKUb04D6Y1HGFJ2j44MiPhJlcHDMNH1eKT9mPZkpaxQh16IPOHM-Rq8c7GY4TpYijv5gVLRNqozn0NAkuCXpUo_mg0Tr-afiDipvRaEEPxwt0BmEuK3j64GNROWj0SPiWHTey55B0MsIx5UHILLh04WmmwPmDG4ifF7_wCP0CLVeMNxdipXh-PEHTHLVDZcLRf0WPn8MTCkdzBVXSUdiNbH-MK8kilNThD-XRJxE8GJ_SHOF-VBJ9nDyR6ctR5jvq4xTsZsS1oSF44dKEhxf-Qf-IvjCXQfuIZ0fM5Gh_UA9-hPIeaPN-pKEY9ORwFyceHufwE8kTTJaPiCdeRJPRC48WGp-OXvBZD0-x49fQ8oFGWoR_9MN3sD70oEk0WghFKseP5kP9I_uhHmFEVLyDBz9xot6QNo2hHQ_2I49IVJnRTImPK8Tz4EaPJzMuPogUaREZqOJxfmDco9mOHxp5pHFu9Onx1jgqnbCoHf4RyoeUB96h52C48GiXo4lkGc8DBs1-6Ef-C1N-9CGuHq0qC2EY43ks6Ih34c5GXMfVFP3hkUcoB_-h7miaxqiNHuYgrh9q6cjT4wmaofIjXMuHfUIT6miVHKUP1z_-Ek-m6aiWo_kQ8qmgWwiPhomSMbhOHH9wpHwS48qHK8SVwvNxXMsJXTfeOOgHLYK-VnguVK_Q5DpunAle9Gmg5caJN4ue4RZO_NDFC0zSfEEOcjvaPPiPMI5Y9Md-aA_RxDVyEzieM0OpywjDYz90SUP8o3vh8KBP-AX1H_kHZdkRWseTPET1FSn08Ej_HKWOJ8SPHs1ZRA9ODTqLiw-eU0Pz5KiT4w3-oOw1aOGF68Ip5M3RRFaOdhfe4zuavMQbWPNxFc6PUjxuF9eFx7iHZH0QO4_whsMnB9OPKzwe4iIi5XSgj0V8BU8e9ESO62ASh0XPEc9e_MpRH3qP57LhOOmKisIPRz-e5Rl0pvgD7WgqXHmKH38yfBUJ-TtCbSH847uE_ujhHfEPypEayC2-EVaeQzuNmN7QBy4RnoeWlUekHy8e1GaF2CmhLdkR8mhKuXgovImOKzt-_AneUFxgPTeOZ0HV5nCNUE7Q4-bRhTqeo18Mvzh6GzqNUznM4zryHE2TEJEaFdOJKfEX_Ib6IH2OP8hzTFcuPPh1PIcuQytfXExFHFp8TI1_vJPQwzk-OxCp7MORoxaDJ8efolYOdxSO1BS0Lju6H35HhF2O6Qr8YN9S-DnCo3lQuXigK4KrJced6LCegxuH50Z_hKkJXtOGXkWTTUKTfCh18Dn-VEIvHU6sg5Fl5Eby_KgvNMNDnI_x40HsQ0_QKD-q9bgSU7gyJ0IfNDsefvhC4w6hM7LA5kfzo0-PK1vwQ1OSHt5m3AvCK6g-eN1xfXDEeInRox_8BKV_XB_44zoC_YidH_-HB036o08dAi_CTj70FLUiVQuq_dAiH6PzYc-OMPXRz8HHI2dEok6h2UH1o9GJ45yOHoz94E0RtD-aKkQchkcT6UQfaD-aHdmDqVUOjxn85UKeBv9wdD9UNQp-4mqGL2qgQZ8U9Dm-jmiCKl_w_Pihn0SJ5jn0ZLiP-GgUj0R14uyxJ41xlFrgFqGa7Cgp5YEZlDr6I5NTsDre5MGP_0NJLcZx_WioZEFNIWcO3XhWxE0O9lXQ5hrRvDhzxEeVqMcTOjBfoccP8kO_x3BIGYzT4JCOE7ni4meCnMd1lDZhHpWYScSdBq9uvEcP72hVKxHOpHiOHyI__PiaQX_RJDnyF_fh6ehxlA_io10E7T4aOceH50TEZRsDP8eLB_Vm9JFwBeH5CE3EfNCWREfcL8V9fDi5SMGULHvw8HgD5tqRfuhZCRp9mEPZ48yOH_-E7gGTHPpxDZ84lLiDPsfF4wqJSkqP5jkO_cOLyNyIJ8J_PEmP88gPLXmUoj-etA9yRcWDPg7SRzku6qhyDXrw2Sh1-BdOlMcFPU1QWvDRLgpid8N1PClGo_ZhpwVvmC-q08JXD80YHLK0JHApB31KnMF__LD1BE-RQ31gOTT-4SGatKjAF41-VJMOrdEFXUd5XMJznEdfjsT2GaMyEkd_PBGuC68lMGtooYl_gCEPMT_COTueDc2Dkgye5IjfGF8DHfVJNDceSyl0HV8S4Tzykke3B2mozIOpXLhTKJKJHI2aHa2YMMGPXXCeUzjxJDuu40Jzow-F_AcDAADICAakMcIQQ5wCBBigEFFEOKWMEYApYoQChAHCAaAIEAaAQ8AIp4gQxgBBjCAAAEcMQEgAAAggBAnAAELEECKAMgoB4JhQwACEiAFGAIARAEJQp5BB0BHEKAAMCEEIAUISAAAhTFADFCOSIOEMUAiQZlCCAggrgETMGAIAhYgAYQSBBhAEkAGAKEFIIgYZJARBAjlDCCBCKigMQQB5AgwgCBEAkBSACGEQUIwgAARSQDAHnAFAUUEAAMgyxxAywjBrgLKAEoSQAQxBYAVEAiiDGCAFOeUMggAwQpkCSjhgmDEIKAFEEEggASAAChAhhBQEACeIAEQBpBRhCgjhrDHCEEqEgQ4JIBAAQEEBBDIUGNKIQEyIgQhTUDCDhDFEKMSEAIQACIRQjADIjCBCMgaUU8JYQCACggglBEFGIAEIcIgZDwwyxBACiEHAEEeUMEIoQpAByjECDFBGgaCYQgQZBwARSiIRiRDMCMAEE0AYhAhBVGhEoCAAEAWMIYAyAQwSQgJhlLAWSYOEAIxIpAABhCDEhDOMAA0QQB4SRwQQxADoEMFAGAAEkBAgiQBgRAmApGIGAFEIAsZYhAAGTABAiDAIKEKcAooIQYgkChjGBHKIIEAQQYoaQxAgAAolEHMAGCAEE00IYgTBxFADkCCAMiCIIYAgIAwxxghnFAUEAAIEcUoZrwUQBklAHGIGSYEYQAggxwQwBAFlDAAUCC0UFoRhYAglSgigABEAEeUMEghYSIBWxShigIMSCQEkkowRZIEFDkhFIGAOUUEBQFYxRAgFSAhkBEKQGGGAABQowgwFgFEAtEFWKKAEQIQFaBghhAiggARKECC8AgQIKIgGylBEpADMGQEIGQwYgSChUigkChHKMAMYs0ABR4BlABgFEDBGCiGRA4kpoAwQCACCoBDQGOCRIIpDoYgA')
                ->setDuration(256),
            (new \AcoustId\Submission($this->instance->getClientAPIToken()))
                ->setFingerPrint('AQADtEmiKEnCREliXNKDB03RKtGhdDoaaMd_7IF2rkEbx8FD9MnB5BE-JTs-4fiHnA_8OMdpC7dAfRk-nMqKxn4xUe7xE_eLRkl2VEyPXMcP8UeePRi34zl4xUi_FHIl_NAZXcGzB30i5PASJYpRksYdBNIzPEcz6YLWJEc-o8k-lPA9fMeb447gZziOcJXyQO-OipGS4tvxozoalblxLjqeo1eQfkePPgPlFveEMxV8CWHBHz-eiYGDQ4tyhNfw42_QP2iy4_hyI9-coHmiFOFxbQpOpglCZjmm5FDzHPmI_vDhkegbfMfFGPlRPTI-Dt_g03gNXchXD352HG4j_EJJfdgR9kg4NFWyBk8y40Bzoo6xK7hIw3RyXMEeG4_Q1Me540GYHx-fQkcJHsyDMnfgHbqAaBeePCHcKwhZHPqPPA2aB0Wfo5kuHB-q47C24w_-48fx44afGP-DH04mnShxI8yN5NWL5olS_Al-Ct9xpRd-_ML9ovmHY7sRnviNtvCVo6My9DAP_PA9nDYE_8j3wDuefnj0YCtl_IFFVG6OT-gz-EcO8UeI78WuPEH4QOOPfEKlG78Cipzx47rxRMeP8D2Sj8QDjpeCxx_ad2hKZXgk5DXEh9h_6MR3fAkDLd0RXhFxBYWlw4121B9CHslyBauPs-D1BM2W8EGoHd-Pn_DZ4Dl4XMeVCGobQd6He5URkgyF7aRwRaPwfPCfwcel4Ef940yCvmieB--OUUc-CYnySBT8wc9QPUoEXnmCRuFhHk8OH22iK5FwSUyQQ7wwnUbTNKOg67jwqMmRJ4qD88EfoU00-EfIDleGyjw2NaGD_jKkSAyapciDXgua48SXBVcVxD4O_cEjIuyDB9yWwX0inNYMkmF-NFUUiuAdJB_CsDt64spB6wkuHk2dodyRB4lyDs2T4-GOXyKYDp6UIdODHj8ivsE1fcOPB8ePP0aYWU-gOSp15Lgp-Doe7FmO5-BMr2ji_Kh4JCfSjieu49KD56i-ozn4hY7w8Pi0o0_R1GMxTyUeXKgVJS0aZeGRKyuhTzuQVviS7MGPq-iJdEqiC5oo-cgzND_qD08e7Bx6uAoj1Omxsxzi_NAjNJFMhM4u5LrQ8IIieUK-hTgTvBaaBwffIG3EQ_t65InQX_CTpGAsG2UUwpG27PBRufjR5we1Xjh1hMlzXDz-oz_Mo76FkNNg9OrBPogjoaJ4QUd-eDu-4bCO6nrwXwGTSUGrHP_x463wEJd0fHi6IxTpJThESjOy_Oi9Iz5k8vieEDmPP_iCego-ZIdONoj_rHh8wpOY44xMlMnRVMg1F1o6Z8hKhiv-w_owEWd2hJJw5vgPiPURjiJOSRfawyd64r8RPYeqbsg1Bse1HHweNKF_9Aw-pQ_yI5fQNTKoHz-qfZiVxsEpE-ETQdQRH31y_HiUPEKpozlDPLgx5jEuJkTyRMiTSTj4oz-anQue7eBznBn-4zmmcEKdDD_RD4eP83hyJOdDpBG615hJPMfndGBEsYMfnMj2HJ4VML3wSNnRhzmco9B53MY14Q2FS_qC_0LnJRrE_LgEHtpxyQg1LjjzBb_RR8pxRQi0jgifyPguZagySQeTLVFy49QJf0dWCcklJUfTRctRmeGwHtUJ9-iPU1yRHPmzo-1xKQncLwKmM0afdWh6ZGuyQE8kGXnI48qiDVXzoMlZfDn-wcXxPqiV6GCiCw_mLkcb-bCyHbUYVM6I9Eh-lFqOn0e9J4MrHf3xKDidIvqR7LlwRTz6hji_oM8tNE_xEU9OXLmCX7hpXIwxJU9QJziPo8db-DySNTpyD031oOWFl8Z-HHmNOxJu7GuOkOwL_6iY4kyPIw_0XMdf5I_xE9WzIw8THc-RHm9YHJcu4jEexUMvnCx2JcMPxo3RfB96BWF-QuWRJ8cnHU22LKlQa6GE5-iPLHmhV0L0q-h1IW2ONm6gl_iHt7g05NpxaUkZNNxxPDkmNxyuHF9eTIUPR_vR_dgRPvMh9kemaw168Dp-afgYBtcxJU1Q6_gfFeF3dIdq6cZ15G0mNFEyD-t1HJUjFdke6UNyEteOSlKI1zh4Hc134T3-oU6INNYFZcov5NmCr8eTEK54_DjCHJ9z6EmP5hJR_dCP6hxCXcdzoV9y-PpQUTl64kVYaTleqLqO6DnKmTiP4s6P82itw3mMIxcU6fiP47mG60L-DP10NFUW_NhRnWj0EOeFJ4keGSeD5jrCH3s06JKUox9uEumFWsI1fHlwTJKMxpoRkT90Icw0oUvG4M0xXckN__hk7LtRMsuJh8YUVNSFHN_mok6zQjyazwxyZcKv4sesxEdTZUTRH58QmtoGmUF-lOQwhQsZ4sFFEv-RK4EuCrkSEbvR8vhT3JjiH7l4qF-44D2eIWQHa45QR8eP8PvgHZKaPPiUzUifEQ-OR8OjMugePDiepgqu-Ea2o-fB5Iml4MdR9gjz4S9-nMmH9xOuI3wgnsgPPjqeI18HfVKIUJ-FH99S8DkeEcnyBDlbOM6THNZuVCpzXCeaDT1Ci5uQ8LXxs2ASH_-wJ0d9pIc5RtAJd0f4CZ8YXfiK5uiDWSKJi2kQSJGIcKqCy2Rx58HzwXmO7zh-1IqK9yp4eBfK5An2GpeGcI0CBKgwAgDihBICASeAMQIhAJAwARhDAAJAOQmIUcIgBQTCABAEXOAMCcQEQgYYBBgAQCDADAOAKGWQEsowgCiRTFrhiBEMAEaYAQgS5hgxADHgBHKICCAUGAKIh4QHiGQBFCJGCWeEAsajLRwTTCgDhJNAIEaOkAYSYAgV4lGKAFBEMoqEAQwhQYgDRBlADDAAESIEUJAIBZBgghPGADCGKCEkEMYQoQRBBhkBAGCCWCEEEoAARJADAAMuiHEQEEGsAwZgIpAjQlGOEHIAIEQAAcwRIIAAygBlgAAQEAEoAgBIKYgBACgmEHDCGmGUMIEIoBTRQCkEAKNOIYKQ0VwBIwQQSBSnhEAOSUcMAMAIIAQglBHBODCOIOYQwQAYRJQBwggggLGQAKGAUghpJYwBTCjCADCUAGCEUkAggRRAgCBHhCBAECUIUEIAcIBAAAABhABEIUcUQ4AJ4YQxAgAAFHDCGQYAAUAojQAxDBAmDHAAMAkIEQAJgIAhRAAhCCKGKCIZEIIMgxQhDjAoAEAWWCyIEQAxYBiASIiGHDCEIEOcAJA4JAxADEHFEAEAEECYSkwIYABAAhAhkCBACAIdAw54QJAAQggBgEAIIMWkFAQYBoAxyAhFgBGCMKCIIEIAIIRBDglEGAGCIIoVE0whJogRUAECiECCEYeOEEQQQJQAQChhgUGGMsGEBQIYASAyAiApJHDACYEBcAwhAQxhEBoCEAMEGCEAIIgIIgwREAgghAIEICBEEEAoJYIRhgEkBDASEASAJF0IYSCgEAABGBGCCCsswgYYYgACAAIAGDAIEcUIQgYBwaymBigDCDGCCICsgQooEAADighiCEBEGTAIcEQYKIxhxoEBEDLCaEMEIsQIICQB0AggkUDMI0MYQ0IQIYAByBJAmCFACIUU0EgQRoAAFCBjjBECGGCYCUQQwQSCJBogDIACEUCUMcBBJYAAyDGCAA')
                ->setDuration(238),
        ]);

        $result = json_decode($result->getBody()->getContents());

        $this->assertEquals('ok', $result->status);
        $this->assertEquals(2, count($result->submissions));
    }

}
