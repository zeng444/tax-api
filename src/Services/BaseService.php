<?php

namespace Tax\Services;

/**
 * 获取Token服务
 * Author:Robert
 *
 * Class Token
 * @package Tax\Services
 */
abstract class BaseService implements ServiceInterface
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
     * @return bool
     */
    public function validate(): bool
    {
        return true;
    }

    /**
     * Author:Robert
     *
     * @param string $token
     */
    public function setToken(string $token)
    {
        $this->params['token'] = $this->token = $token;
    }

}
