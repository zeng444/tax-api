<?php

use Tax\Http\Client as HttpClient;
use Tax\Requests\IndividualIncomeTaxSummaryRequest\Collection;
use Tax\Requests\IndividualIncomeTaxSummaryRequest;

define('ROOT_PATH', dirname(__DIR__));
define('DEMO_PATH', __DIR__);
include_once ROOT_PATH.'/vendor/autoload.php';

try {
    $config = include_once DEMO_PATH.'/configs/config.php';
    $client = new HttpClient($config);
    $reportRequest = new IndividualIncomeTaxSummaryRequest();
    $reportRequest->setTaxDateRange('2019-09-05', '201-09-06');
    $reportRequest->setReportDate(date('Y-m-d'));
    $reportRequest->setPlatformCompany('?', '');
    foreach ([1, 2] as $item) {
        $reportRequestCollection = new Collection();
        $reportRequestCollection->setTaxRate(0.5);
        $reportRequestCollection->setPeopleQuantity($item);
        $reportRequestCollection->setTaxIncomeTotal(1);
        $reportRequestCollection->setTaxPayableTotal(1);
        $reportRequestCollection->setTaxPaidTotal(1);
        $reportRequestCollection->setTaxRefundedTotal(1);
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
