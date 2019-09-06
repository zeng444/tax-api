<?php

use Tax\Http\Client as HttpClient;
use Tax\Requests\TaskRequest;

define('ROOT_PATH', dirname(__DIR__));
define('DEMO_PATH', __DIR__);
include_once ROOT_PATH.'/vendor/autoload.php';

try {
    $config = include_once DEMO_PATH.'/configs/config.php';
    $client = new HttpClient($config);
    $hirerService = new TaskRequest();
    $hirerService->setUUID('?');
    $hirerService->setBasicInfo('', '?', "?", "?", "?");
    $hirerService->setPublishInfo('PC', '?', "?");
    $hirerService->setEmployerCompany('?', "?");
    $hirerService->setEmployer('?', "?", "?");
    $hirerService->setHirer('?', "?", "?", "?");
    $hirerService->setHirerAcceptInfo('?', '?', "PC", "?", "");
    $hirerService->setPayment('?', "?", "?", "?");
    $hirerService->setGoodsNo('?');
    $hirerService->setEvidenceImage('?');
    $hirerService->setPayee('?', '?');
    $hirerService->setSettleInfo('?', '?', "?", "?", "");
    $hirerService->setDuration('2019-09-01', '2019-09-05');
    $result = $client->execute($hirerService);
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
