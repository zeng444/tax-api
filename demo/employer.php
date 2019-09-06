<?php

use Tax\Http\Client as HttpClient;
use Tax\Requests\EmployerRequest;

define('ROOT_PATH', dirname(__DIR__));
define('DEMO_PATH', __DIR__);
include_once ROOT_PATH.'/vendor/autoload.php';
try {

    $config = include_once DEMO_PATH.'/configs/config.php';
    $client = new HttpClient($config);
    $employerService = new EmployerRequest();
    $employerService->setCompanyLicenceNo('1111', '22');
    $employerService->setCompanyBusinessScope('xx');
    $employerService->setCompanyName('1111');
    $employerService->setCompanyType('0');
    $employerService->setCompanyAddress('1111', '?', '156', '1');
    $employerService->setCompanyRegisterCapital('1111');
    $employerService->setCompanyLegalPerson('1111');
    $employerService->setCompanyRegisterDate(date('Y-m-d H:i:s'));
    $employerService->setCompanyInvestor('?');

    $employerService->setPlatformUUId('1111');
    $employerService->setPlatformRegisterDate(date('Y-m-d H:i:s'));
    $employerService->setPlatformPublisher('xxx', '', 'ud');
    $employerService->setRevenue('?');
    $result = $client->execute($employerService);
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
