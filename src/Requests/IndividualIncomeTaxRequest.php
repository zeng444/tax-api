<?php

namespace Tax\Requests;

use Tax\Requests\IndividualIncomeTaxRequest\Collection;

/**
 * 个人申报信息信息接口
 * Author:Robert
 *
 * Class IndividualIncomeTaxRequest
 * @package Tax\Requests
 */
class IndividualIncomeTaxRequest extends BaseRequest implements RequestInterface
{


    protected $collection = [];



    /**
     * @var
     */
    public $startDate;

    /**
     * @var
     */
    public $endDate;


    /**
     * Author:Robert
     *
     * @return string
     */
    public function getServiceId(): string
    {
        return 'postSbxx0001';
    }

    /**
     * Author:Robert
     *
     * @return string
     */
    public function getNodeName(): string
    {
        return 'sbxx';
    }

    /**
     * Author:Robert
     *
     * @return bool
     */
    public function validate(): bool
    {
        return !$this->hasMessage();
    }



    /**
     * 税款所属起止
     * Author:Robert
     *
     * @param string $startDate
     * @param string $endDate
     */
    public function setTaxDateRange(string $startDate, string $endDate)
    {
        $this->params['skssqq'] = $this->startDate = $startDate;
        $this->params['skssqz'] = $this->endDate = $endDate;
    }


    /**
     * Author:Robert
     *
     * @param Collection $collection
     * @throws \Exception
     */
    public function addCollection(Collection $collection)
    {
        if ($collection->validate() === false) {
            $this->setMessage($collection->getMessage());
        }
        $this->collection[] = array_merge($this->params, $collection->getBody());
    }


    /**
     * Author:Robert
     *
     * @return array
     */
    public function getBody(): array
    {
        return $this->collection;
    }
}
