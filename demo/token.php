<?php

use Tax\Http\Client as HttpClient;
use Tax\Requests\TokenRequest;

define('ROOT_PATH', dirname(__DIR__));
define('DEMO_PATH', __DIR__);
include_once ROOT_PATH.'/vendor/autoload.php';

try {
    $config = include_once DEMO_PATH.'/configs/config.php';
    $client = new HttpClient($config);
    $token = new TokenRequest();
    $result = $client->execute($token);
    //        print_r($client->debug());
    if (!$result->isSuccess()) {
        echo 'msg:'.$result->getMessage().PHP_EOL;
        echo 'code:'.$result->getCode().$result->getCodeMsg().PHP_EOL;
        exit;
    }
    $data = $result->getData();
    echo ($data->token ?? '').PHP_EOL;
    echo ($data->expires_at ?? '').PHP_EOL;

} catch (\Exception $e) {
    echo $e->getMessage().PHP_EOL;
    echo $e->getTraceAsString().PHP_EOL;
}
