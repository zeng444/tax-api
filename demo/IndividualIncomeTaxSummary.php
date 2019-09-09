<?php

use Tax\Http\Client as HttpClient;
use Tax\Requests\IndividualIncomeTaxDetailSummary;

define('ROOT_PATH', dirname(__DIR__));
define('DEMO_PATH', __DIR__);
include_once ROOT_PATH.'/vendor/autoload.php';

try {
    $config = include_once DEMO_PATH.'/configs/config.php';
    $client = new HttpClient($config);
    $reportRequest = new IndividualIncomeTaxDetailSummary();
    $reportRequest->setTaxDateRange('2019-09-05', '201-09-06');
    $reportRequest->setReportDate(date('Y-m-d'));
    $reportRequest->setPlatformCompany('?', '');
    $reportRequest->setTaxRate(0.5);
    $reportRequest->setPeopleQuantity(110);
    $reportRequest->setTaxIncomeTotal(1);
    $reportRequest->setTaxPayableTotal(1);
    $reportRequest->setTaxPaidTotal(1);
    $reportRequest->setTaxRefundedTotal(1);
    $result = $client->execute($reportRequest);
            print_r($client->debug());
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
