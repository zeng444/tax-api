#  税务对接 SDK

## 初始化客户端
```
use Tax\Http\Client as HttpClient;

$opt= [
  'connectTimeout' => 1,
    'logFile' => DEMO_PATH.'/logs/api.history.log',
    'cacheFile' => DEMO_PATH.'/logs/token',
    'systemId' => '..........',
    'gatewayUrl' => 'http://.............',
    'rsaPubPath' => DEMO_PATH.'/configs/rsa_public_key.pem',
];

$client = new HttpClient($opt);
```

## TOKEN维护重写

- 继承重写Tax\Http\Client下缓存方法
- 返回对象包含 token和expires_at属性即可

```php
protected function setTokenToCache($data);
protected function getTokenToCache();

print_($client->getTokenToCache())

```
输出
```php

stdClass Object
{
  [token] =>'xxxxxxxxxxxxx'
  [expires_at] =>'2019-09-06'
}
```

## 服务调用

###  获取token 
```
use Tax\Requests\TokenRequest;

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
### 所得税汇总

```php
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
print_r($client->debug());
if (!$result->isSuccess()) {
    echo 'msg:'.$result->getMessage().PHP_EOL;
    echo 'code:'.$result->getCode().$result->getCodeMsg().PHP_EOL;
    exit;
}
$data = $result->getData();
return $data ?? '';
```

### 其他我懒得写

.............
