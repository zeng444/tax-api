<?php

use Tax\Http\Client as HttpClient;
use Tax\Requests\HirerRequest;

define('ROOT_PATH', dirname(__DIR__));
define('DEMO_PATH', __DIR__);
include_once ROOT_PATH.'/vendor/autoload.php';

try {
    $config = include_once DEMO_PATH.'/configs/config.php';
    $client = new HttpClient($config);
    $hirerService = new HirerRequest();
    $hirerService->setUUId('?');
    $hirerService->setCompany('?', '?', '?');
    $hirerService->setName('?');
    $hirerService->setBirthday('?');
    $hirerService->setBankCard('?', '?', '?', '?');
    $hirerService->setCertificate([['no' => 'CCNP-82382032840', 'name' => 'CCNP']]);
    $hirerService->setEducation('?', '?', '?', '?');
    $hirerService->setOccupation('?');
    $hirerService->setRegisterIp('127.0.0.1');
    $hirerService->setRegisterMac('fwfmacdz');
    $hirerService->setIdCard('x', '?');
    $hirerService->setMobile('1211545454');
    $hirerService->setAddress('1211545454', 'xxx');
    $hirerService->setBusinessScope(['ui']);
    $hirerService->registerDate('2019-02-12');
    $hirerService->setGender(HirerRequest::MALE_GENDER);

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
