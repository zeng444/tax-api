<?php

namespace Tax\Http;

use Tax\Requests\RequestInterface;
use Tax\Requests\TokenRequest;

class Client
{

    /**
     * Author:Robert
     *
     * @var int
     */
    protected $httpTimeout = 2;

    /**
     * Author:Robert
     *
     * @var int
     */
    protected $connectTimeout = 2;

    /**
     * Author:Robert
     *
     * @var string
     */
    protected $version = '1.0';

    /**
     * Author:Robert
     *
     * @var string
     */
    protected $gatewayUrl = 'http://47.105.216.166:8083';

    /**
     * Author:Robert
     *
     * @var string
     */
    protected $systemId = '';

    /**
     * Author:Robert
     *
     * @var
     */
    protected $logFile;


    /**
     * Author:Robert
     *
     * @var
     */
    private $_requestInfo;

    /**
     * Author:Robert
     *
     * @var
     */
    private $_response;


    /**
     * Author:Robert
     *
     * @var
     */
    private $_sign;

    /**
     * @var
     */
    private $cacheFile;

    /**
     *
     */
    const HTTP_USER_AGENT = 'H.Y.D Bot V0.01';

    /**
     * Client constructor.
     * @param $options
     * @throws \Exception
     */
    public function __construct($options)
    {
        if (isset($options['systemId'])) {
            $this->systemId = $options['systemId'];
        }
        if (isset($options['version'])) {
            $this->version = $options['version'];
        }
        if (isset($options['gatewayUrl'])) {
            $this->gatewayUrl = $options['gatewayUrl'];
        }
        if (isset($options['httpTimeout'])) {
            $this->httpTimeout = $options['httpTimeout'];
        }
        if (isset($options['connectTimeout'])) {
            $this->connectTimeout = $options['connectTimeout'];
        }
        if (isset($options['logFile'])) {
            $this->logFile = $options['logFile'];
        }
        if (isset($options['cacheFile'])) {
            $this->cacheFile = $options['cacheFile'];
        }
        $this->_sign = new Sign($options);
    }

    /**
     * Author:Robert
     *
     * @param $url
     */
    public function setGatewayUrl($url)
    {
        $this->gatewayUrl = $url;
    }

    /**
     * Author:Robert
     *
     * @return mixed
     */
    public function debug()
    {
        return [
            'request' => $this->_requestInfo,
            'response' => $this->_response,

        ];
    }

    /**
     * Author:Robert
     *
     * @param string $file
     * @return string
     */
    public static function imageBase64Encode(string $file): string
    {
        $type = getimagesize($file);
        $content = file_get_contents($file);
        $binary = chunk_split(base64_encode($content));
        $imgTypeMap = [
            '1' => "gif",
            '2' => "jpg",
            '3' => "png",
        ];
        $type = $imgTypeMap[$type[2]] ?? 'jpg';
        $img = 'data:image/'.$type.';base64,'.$binary;
        return $img;
    }

    /**
     * Author:Robert
     *
     * @return string
     */
    private function makeSeq(): string
    {
        return md5(uniqid(true));
    }

    /**
     * Author:Robert
     *
     * @return bool|mixed
     */
    protected function getTokenFromCache()
    {
        if (!$this->cacheFile || !file_exists($this->cacheFile)) {
            return false;
        }
        $cache = @file_get_contents($this->cacheFile);
        if (!$cache) {
            return false;
        }
        $data = unserialize($cache);
        $token = $data->token ?? '';
        $expiresAt = $data->expires_at ?? '';
        if (!$token || !$expiresAt || time() > strtotime($data->expires_at) - 3600) {
            return false;
        }
        return $data;
    }

    /**
     * Author:Robert
     *
     * @param $data
     * @return bool
     * @throws \Exception
     */
    protected function setTokenToCache($data)
    {
        if ($this->cacheFile && !@file_put_contents($this->cacheFile, serialize($data))) {
            throw new \Exception('无法写入token cache，请检查'.$this->cacheFile.'可写入');
        }
        return true;
    }

    /**
     * Author:Robert
     *
     * @return string
     * @throws \Exception
     */
    protected function getToken(): string
    {
        $data = $this->getTokenFromCache();
        if (!$data) {
            $tokenRequest = new TokenRequest();
            $response = $this->execute($tokenRequest);
            if (!$response->isSuccess()) {
                throw new \Exception('['.$response->getCode().']'.$response->getMessage(), $response->getCode());
            }
            $data = $response->getData();
            $this->setTokenToCache($data);
        }
        return $data->token;
    }

    /**
     * Author:Robert
     *
     * @param RequestInterface $request
     * @return \Tax\Http\ResultSet
     * @throws \Exception
     */
    public function execute(RequestInterface $request): ResultSet
    {

        $result = new ResultSet();
        if ($request->validate() === false) {
            $result->code = ResultSet::CLIENT_VALIDATION_ERROR_CODE;
            $result->message = $request->getMessage();
            $result->status = ResultSet::ERROR_STATUS;
            return $result;
        }
        $nodeName = $request->getNodeName();
        $postFields = $nodeName ? [$nodeName => $request->getBody()] : $request->getBody();
        $postFields = array_merge($postFields, [
            'service_id' => $request->getServiceId(),
            'system_id' => $this->systemId,
            'sign' => $this->_sign->encrypt(),
            'seq' => $this->makeSeq(),
            'charset' => 'UTF-8',
            'timestamp' => (string)date('Y-m-d H:i:s'),
            'version' => $this->version,
        ]);
        if ($request->requireToken()) {
            $postFields['token'] = $this->getToken();
        }
        try {
            $resp = $this->httpPost($this->gatewayUrl.$request->getServiceId(), $postFields ? json_encode($postFields) : '');
        } catch (\Exception $e) {
            $result->code = ResultSet::HTTP_INTERNAL_SERVER_ERROR_CODE;
            $result->message = ResultSet::API_ERROR_CODE[ResultSet::HTTP_INTERNAL_SERVER_ERROR_CODE];
            $result->status = ResultSet::ERROR_STATUS;
            return $result;
        }
        if (!$resp) {
            $result->code = ResultSet::HTTP_NO_CONTENT_CODE;
            $result->status = ResultSet::ERROR_STATUS;
            $result->message = ResultSet::API_ERROR_CODE[ResultSet::HTTP_NO_CONTENT_CODE];
            return $result;
        }
        $respObject = json_decode($resp);
        if (!$respObject || !isset($respObject->code) || !isset($respObject->desc)) {
            $result->code = ResultSet::HTTP_NO_CONTENT_CODE;
            $result->status = ResultSet::ERROR_STATUS;
            $result->message = ResultSet::API_ERROR_CODE[ResultSet::HTTP_NO_CONTENT_CODE];
            return $result;
        }
        $result->code = $respObject->code;
        $result->message = $respObject->desc;
        if ($respObject->code != ResultSet::API_100_CODE) {
            $result->status = ResultSet::ERROR_STATUS;
            return $result;
        }
        $result->status = ResultSet::SUCCESS_STATUS;
        $result->data = $respObject;
        return $result;
    }

    /**
     * Author:Robert
     *
     * @param $msg
     */
    public function writeLog($msg)
    {
        error_log($msg, 3, $this->logFile);
    }

    /**
     * Author:Robert
     *
     * @param $url
     * @return bool
     */
    private function isSSL($url): bool
    {
        return !!preg_match('/^https/', $url);
    }

    /**
     * Author:Robert
     *
     * @param $url
     * @param string $postBodyString
     * @return mixed
     * @throws \Exception
     */
    private function httpPost($url, string $postBodyString)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($this->isSSL($url)) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        }
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->httpTimeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->connectTimeout);
        curl_setopt($ch, CURLOPT_USERAGENT, self::HTTP_USER_AGENT);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postBodyString);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Except',
            //            'Content-Length: '.strlen($postBodyString),
        ]);
        $this->_response = curl_exec($ch);
        $this->_requestInfo = curl_getinfo($ch);
        if ($this->_requestInfo) {
            $this->_requestInfo['body'] = $postBodyString;
        }
        if ($this->logFile) {
            $date = date('Y-m-d H:i:s');
            $this->writeLog('REQUEST ['.$date.']'.json_encode($this->_requestInfo).PHP_EOL.'RESPONSE ['.$date.']'.$this->_response.PHP_EOL);
        }
        $curlErrorCode = curl_errno($ch);
        if ($curlErrorCode) {
            throw new \Exception(curl_error($ch), $curlErrorCode);
        } else {
            $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if (200 !== $httpStatusCode) {
                throw new \Exception($this->_response, $httpStatusCode);
            }
        }
        curl_close($ch);
        return $this->_response;
    }
}
