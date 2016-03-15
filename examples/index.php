<a href="index.php">Index</a> |
<a href="index.php?type=trackid&c=">Look up by track id</a> |
<a href="index.php?type=fingerprint&c=">Look up by fingerprint</a> |
<a href="index.php?type=submission&c=&u=">Submit data</a> |
<a href="index.php?type=status&c=">Get submission status</a>

<br><br>

<?php

/**
 * Below you can find example script use cases.
 * Info about API could be found at: https://acoustid.org/webservice
 *
 * Additional info here: https://musicbrainz.org/doc/Development/JSON_Web_Service
 */

require_once __DIR__ . '/../src/bootstrap.php';

\AcoustId\Exception::setExceptionHandler();

# Parameters - you can pass params as index.php?f=fingerPrint&d=100&t=trackId&c=clientId&u=userId
$f = get('f', 'AQADtGGiJkkoScGhR8ij48eXG_vh-riSIPmDMDs-YTV6mJwERxKSyLGFfMfRrEO74zkuHsmjZDXCZBcm5cKXBScQ-oLIxEe6orSnoMrjoCGHX8bD48oyIewh7sEfot_xlNCN78h3lMN53NiwE5d1w8tRT8eTK3h6PLtQcoUpvPgR6kFPuGKGz9Ceo-PhEx9MNcZ1GP9x97hHmD6OfjhPPIRmSYL94ckkhB-q43BanPzw5UIeTLRyQfmHT3jMor_gJ11QWsT1oMvRH7py9IcjXEc7HScfofrxxjL0FHdwH_5wHd7CMNDwCV0O8zhP9Dt-PEIpB-l3nHAb-B3KCc-C_kS69igvXDreDaGbwPGFzsfOHDG-ENqPZ4uFHIfJHSN1_Efc4zmOWgse6wirHOnRH5-gqcf7FM1z5Ane6fgRPvngH99xfLHwSzj6XLgk_EXVw4ImC72g44ePp-o0HLEv5Ef7o7-Ek3hDaFiPo7qOM8mhGumDX_gPv8RxDadwGzkjJNlOHPfRSMtxfEf4QuRQbx5yhOsxhQ-eoT-2Cz4xRsdZdfAjXOuEHf4GXbAj4XGh8An-ELeOZxtsXLbQS9A7VDQ8Hq0-aEtNwUeoJ8Zc9DBvhHrw59CeG86Y48Qp-CEemCQqbeqMN4f2otnR92honCqJHk3wZcOPK0Fz9AreoPrhwyMRXtKOL3ZR-vCFshxCs_gkHu92iP3hXMfzYc_wH9-PPTq8B-2hZxz-4g2akUflQ08e3Cip-XBFaH-LKlOWKnBENsiP-6ibRXiiDfmhSb1ivJ4QE78Eo5eOXDzUI9dyCefxS0GfrGhO4i_yRVDpdOglpEflI9_Qf1BYo92FfVFGIr7R9YhNDmYU4iPsCzqjY3p2HPnQH38IO9nxFxfC0LgENc0Rar_gzfgJn8V1ME_QTzgPM5cQkpegnhKihlJwHv2RVsMDcfiRN4F55MkX7Ia-JYR_sP0M59CphUInxCKPH5ce9MyRM4HGHj_C7BqqPvi01Mj2ERpzhKno4tpx0fgQNiO-tBBrEheF4xLObILYCVeY40fqHC_Kxwj1HacOj8fpBce5YT7Sf_gXXJyOszo-HbkKQz9c8TGOtCLhMcyRvph66KSEazReRUc74uFhKxfOG3oPLz-m49FRMZeIr4eqnPglNIee47JxLmhOVMtK7EuQx6qKniKRTuNBoX3x09CO7UfqCLcK_0UXH79EvBQ6wz_yQ-dR6RHyMMODPMd-6JrRH018HM-Vof-Q9vzg8biEK_COiyZcB9-F-IGoHT1z5MMuNO6DduHxHqEgPkMuPMd3w9-x-rgIaoqy4scF_0cX6mhJNbiULDgOpDsYLeIDLQ5zhDv2tKgalmh2FVeNXOgJLXuOu0XlEE7Yo_-EyYL-YmfwtoJYHf1x6kX4MGgeXLvwaD_iFs0oHR8eDf6Okid-QR0aHZUnnAh7_IiPlx6e5HBWDdqLox8jpGmPKseXGb1xIiWOV-xw4_iN_8gTisGRCndx_MZ_-D2q54gaVsd_vAfzw6mWGkcna4hIU4MOhHalwDz6_OjLw49xCw9OxF6CCy_xQeQunPADmzr-4xnQiL1wFf_RHP3xY--K7xyqG1am4T5847mg5_hztKONizl6gkq6lNAeHn8O96D3ED-aLzlK5tjFoz_-4OqOT8HFF-l4_AjHJENfiLfQ5cKlB7kW9HBUGvmF_tCPK3sw9YZT4-Hx5Dgl4cer4IcdXMV74DwY_fh-vDr6HEdvhJcCX0Q_5Goq9BOeHzq7Isun4xn6I4wUvjhT3IHyx7iOXDn6Br_gH1fSomfQr8KzBykv4Sf6Fn0Ki0etEzqPdoOPPsRZ_GilZ3hmEbocWJEi4CslXIuxH5Wh6RthRhS-RTEe6MePb0d_4dtxzgj1wB3B9-hrfPTQ_EF6xdC04bitwXpwHwfvEn-EfhBP4w_eRohOnOMKT9vxI3UYdA90HydaaS-aScyLkziN6eHh4WEHXtwSWDxe-BDjJzDFZBp-ZE8ewRd6_GjGsNFQ9bjQPAsYfkPeL3hj_LiG5sKP_tDxL0Fm7cKLV8PFI_yhpTp-RDza4Q_cJLhhvsRJ48rQRGuO7zjCqEseaBcQPj22M7B2TK9R_dh-Ffmhq8cVIVq1oT_-4JlTY14QioNfQz_448bMHFp34kefw8_gPMeu5NDhLErh47_xwGkKzSK-GOF-nAa-6eiPUFRg7TN-QbvQSu1wuIoIMcczvBRiHT-8T2A0JUd2kfjTQUv8FP1w1ehzXId5wyuOwyMTtGpR_fC4EKoPH_mHc7iOlxKmNwhPOPLRcsFVlD-cIj88GTmDQw_07cFV6Dm0XDG-HWePEHkO8_jxHOKPT_DRo9YIP0f1Qxu28HiYYyuO4yZhRjwqrbhQk4YWFR9R9vAlXLD-QVeYG7mIHz8cvcGNHw-DVI0g9kOuD5fCZEKzKsYn4iz6I6169EuP6zgaVkJJhgJGCLPAGCMQQYgyoohDCCGBmDMMAYKUYsgxQQiDQCgiAaMICEkUoIQZgRQVQCgFmAKCEGAUQMYQkaQSggAkoBAECCGMUVIYJpRwQBIAFDFGCCocIgwA4pRiAnhgFAAKSYUAIAgAI8EQAgphEHkAIwasEgQ4JRAUQAAkIEOAMCCccYYKRRRwFCEEBDBAkkMUEIwI4oBTEAkBEjEKEYEQYAJBIJQgYABDhALEECEhQUZAIogASjILvCAcAgcIMM4gQyigwACCgBAKEGEYAEABggQSAhkihGDGIAEEcQQiKYhQQCAmBAAAMiAQIIBSAIQhAliICBKEYQUQYAgxRABgQkCGABGKGKCAogQajYAQQgEDDAhIAKOkgQoJBBRAjADPmAGCOCKAMIAxmAQBwAkBBEEGUaAQgoAAIZgBABAgiAREKEEEJo4YaIAgAhEmjAEKMcOAcQopIBQnBhkCDAIAEQCY8YIoghwhTAAhFDIMAgCIwohZIIQBiEEBBCJQEgiMIUAAQxQQCChAAEACOAqIoYB5LAUSCjAxCDPMMwIEIEQJBAA3ggADGADEAAWUIBAJQYQAijLGhTXOCiMAMwgYJwSiwiCAgFCMGEYEAEYKQICiyAkgiCDCKAWMEsZRwBA1xgghCZACAcAQIJRQagQi0AKAhBFEKGCEQIRIJwAShgFrGACACYMANcAYQRRhwAihhFBUUKQMA0AhJQBFzhEkgBLIEGGIAUhwRABzQCkCjFAGKCYFEoQIyYRhADJmmBGGImYIAg4IBJAiihACgRMUIQSQEBQwhARBwBAnjCAACgCAIZQAZZyBAEADlEIMGiAAFABJkABgRhCgkEAAKOENEwwpYgARhCBAiAIMAaWIIAZAAbSQwiikmCNEGEEQAQAZhBg1iCAGEDFEKsCYEyJBAIYRwAHAjKEQKSGUEIQQIYgyDA');
$d = get('d', 200); #duration
$t = get('t', 'c97a7693-af5d-4d73-8334-e4588aec169a'); # track id

$c = get('c'); # clientId
//$u = get('u'); # userId - used in making submit requests

$type = get('type');

if (!empty($type) && empty($c)) {
    throw new \AcoustId\Exception('Please, provide the $clientId parameter by passing the ?c=xxx parameter, where xxx is your AcoustId client id for API requests.');
}

# Create the AcousId class instance - we'll need it in any use case
$client = new \AcoustId\AcoustId($c);

# Below comes some dirty include-require stuff, acceptable only for demo needs ;)
switch ($type) {
    case 'trackid':
        require_once 'trackid.php';
        break;
    case 'fingerprint':
        require_once 'fingerprint.php';
        break;
    case 'submission':
        require_once 'submission.php';
        break;
    case 'status':
        require_once 'status.php';
        break;
}

# Output depending on format type
//if ($lookUp->getFormat() == 'json') {
//    echo $response->getBody()->getContents();
//} elseif ($lookUp->getFormat() == 'xml') {
//    pd(simplexml_load_string($response->getBody()->getContents()));
//} elseif ($lookUp->getFormat() == 'jsonp') {
//    pd($response->getBody()->getContents());
//}