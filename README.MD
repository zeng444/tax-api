#  税务对接 SDK

## 初始化客户端
```
$opt= [
  'connectTimeout' => 1,
  'logFile' => DEMO_PATH.'/logs/',
  'systemId' => '....',
  'gatewayUrl' => 'http://................,
  'rsaPubPath' => 'rsa_public_key.pem',
];

$client = new HttpClient([
    'connectTimeout' => 1,
    'logFile' => DEMO_PATH.'/logs/',
    'systemId' => 'dj_jslw_wbyg_20190820',
    'gatewayUrl' => $gatewayUrl,
    'rsaPubPath' => DEMO_PATH.'/key/rsa_public_key.pem',
]);
```
## 服务调用

###  获取token 
```
$token = new TokenService();
$result = $client->execute($token);
if (!$result->isSuccess()) {
    echo 'msg:'.$result->getMessage().PHP_EOL;
    echo 'code:'.$result->getCode().$result->getCodeMsg().PHP_EOL;
    exit;
}
$data = $result->getData();
echo $data->token ?? '';
```

###  ...
