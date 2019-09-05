<?php

namespace Tax\Requests;

interface RequestInterface
{

    /**
     * 请求数据的验证器
     * Author:Robert
     *
     * @return bool
     */
    public function validate(): bool;

    /**
     * 请求的主体
     * Author:Robert
     *
     * @return array
     */
    public function getBody(): array;

    /**
     * 请求的服务名称
     * Author:Robert
     *
     * @return string
     */
    public function getServiceId(): string;

    /**
     * 请求使用的业务节点名称
     * Author:Robert
     *
     * @return string
     */
    public function getNodeName(): string;

    /**
     * 是否需要token
     * Author:Robert
     *
     * @return bool
     */
    public function requireToken(): bool;
}
