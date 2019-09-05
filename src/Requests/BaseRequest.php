<?php

namespace Tax\Requests;

/**
 * 获取Token服务
 * Author:Robert
 *
 * Class Token
 * @package Tax\Requests
 */
abstract class BaseRequest
{

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @var
     */
    protected $token;

    /**
     * Author:Robert
     *
     * @return array
     */
    public function getBody(): array
    {
        return $this->params;
    }


    /**
     * Author:Robert
     *
     * @return string
     */
    public function getNodeName(): string
    {
        return '';
    }

    /**
     * Author:Robert
     *
     * @return bool
     */
    public function validate(): bool
    {
        return true;
    }

    /**
     * Author:Robert
     *
     * @return bool
     */
    public function requireToken(): bool
    {
        return true;
    }

}
