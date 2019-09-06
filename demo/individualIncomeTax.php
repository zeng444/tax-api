<?php

use Tax\Http\Client as HttpClient;
use Tax\Requests\IndividualIncomeTaxRequest\Collection;
use Tax\Requests\IndividualIncomeTaxRequest;

define('ROOT_PATH', dirname(__DIR__));
define('DEMO_PATH', __DIR__);
include_once ROOT_PATH.'/vendor/autoload.php';

try {
    $config = include_once DEMO_PATH.'/configs/config.php';
    $client = new HttpClient($config);
    $reportRequest = new IndividualIncomeTaxRequest();
    $reportRequest->setTaxDateRange('2019-09-05', '201-09-06');
    $reportRequest->setTaxpayerUUId('?');
    $reportRequest->setTaxpayerCompany('?');
    $reportRequest->setTaxpayer('?');
    $reportRequest->setTaxIndustryCode('?');
    $types = array_keys(Collection::TAX_TYPE_MAP);
    foreach ($types as $type) {
        $reportRequestCollection = new Collection();
        $reportRequestCollection->setTaxType($type);
        $reportRequestCollection->setTaxCategory('结算结束');
        $reportRequestCollection->serTaxBaseTotal(1000);
        $reportRequestCollection->serTaxRate(0.5);
        $reportRequestCollection->setTaxPayableTotal('212313');
        $reportRequestCollection->setTaxReducedTotal('22');
        $reportRequestCollection->setTaxPaidTotal('22');
        $reportRequestCollection->setAgentTaxChargeableTotal('22');
        $reportRequestCollection->setAgentTaxPaidTotal('22');
        $reportRequestCollection->setTaxOrigin('22', '?', "?");
        $reportRequest->addCollection($reportRequestCollection);
    }
    $result = $client->execute($reportRequest);
    //        print_r($client->debug());
    if (!$result->isSuccess()) {
        echo 'msg:'.$result->getMessage().PHP_EOL;
        echo 'code:'.$result->getCode().$result->getCodeMsg().PHP_EOL;
        exit;
    }
    $data = $result->getData();
    print_r($data);
} catch (\Exception $e) {
    echo $e->getMessage().PHP_EOL;
    echo $e->getTraceAsString().PHP_EOL;
}
