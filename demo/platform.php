<?php

use Tax\Http\Client as HttpClient;
use Tax\Requests\PlatformInformationRequest;

define('ROOT_PATH', dirname(__DIR__));
define('DEMO_PATH', __DIR__);
include_once ROOT_PATH.'/vendor/autoload.php';

try {
    $config = include_once DEMO_PATH.'/configs/config.php';
    $client = new HttpClient($config);
    $platformInformationService = new PlatformInformationRequest();
    $platformInformationService->setPlatformUrl('http://www.hui.cn/');
    $platformInformationService->setCompanyName('平安国际融资租赁（天津）有限公司');
    $platformInformationService->setCompanyStatus('?');
    $platformInformationService->setCompanyEmployeeNumber('20');
    $platformInformationService->setCompanyRegisterCapital('10000');
    $platformInformationService->setCompanyLicenseNo('91120116329587679E');
    $platformInformationService->setCompanyRegisterAddress('?', '?', '?');
    $platformInformationService->setCompanyBusinessAddress('?', '?');
    $platformInformationService->setCompanyBusinessScope('7269');
    $platformInformationService->setCompanyIndustryCode('7269');
    $platformInformationService->setCompanyLegalPerson('', '201', '?', '?', '?', '@163.com');
    $platformInformationService->setCompanyFinancialPerson('', '201', '?', '?', '?', '@163.com');
    $platformInformationService->setCompanyTaxPerson('?', '201', '?', '', '', '@163.com');
    $platformInformationService->setCompanyTaxAgentPerson('?');
    $platformInformationService->setRevenue('天津市东疆保税港区国家税务局', '东疆港');

    $result = $client->execute($platformInformationService);
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
