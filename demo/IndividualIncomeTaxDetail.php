<?php

use Tax\Http\Client as HttpClient;
use Tax\Requests\IndividualIncomeTaxDetailRequest;
use Tax\Requests\IndividualIncomeTaxDetailRequest\Collection;

define('ROOT_PATH', dirname(__DIR__));
define('DEMO_PATH', __DIR__);
include_once ROOT_PATH.'/vendor/autoload.php';

try {
    $config = include_once DEMO_PATH.'/configs/config.php';
    $client = new HttpClient($config);
    $reportRequest = new IndividualIncomeTaxDetailRequest();

    $reportRequest->setTaxDateRange('2019-09-05', '201-09-06');
    $reportRequest->setReportDate(date('Y-m-d'));
    $reportRequest->setPlatformCompany('', '', '', '', '');
    $reportRequest->setRevenue('');
    $collection = new Collection();
    $collection->setUUID('');
    $collection->setTaxpayer('', '', '', '', '');
    $collection->setTaxIncomeTotal('', '');
    $collection->setTaxBaseTotal('');
    $collection->setTaxRate('');
    $collection->setDeductedTotal('');
    $collection->setTaxPayableTotal('');
    $collection->setTaxPaidTotal('');
    $collection->setTaxRefundedTotal('');
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
