<?php

namespace Tax\Requests;

use Tax\Requests\IndividualIncomeTaxSummaryRequest\Collection;

/**
 * 个人所得税汇总信息接口
 * Author:Robert
 *
 * Class IndividualIncomeTaxSummaryRequest
 * @package Tax\Requests
 */
class IndividualIncomeTaxSummaryRequest extends BaseRequest implements RequestInterface
{

    /**
     * @var array
     */
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
     * @var
     */
    public $reportDate;

    /**
     * @var
     */
    public $companyName;

    /**
     * @var
     */
    public $companyLicenseNo;

    /**
     * Author:Robert
     *
     * @return string
     */
    public function getServiceId(): string
    {
        return 'postGrsdsxx0001';
    }

    /**
     * Author:Robert
     *
     * @return string
     */
    public function getNodeName(): string
    {
        return 'sdsxx';
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
     * Author:Robert
     *
     * @return array
     */
    public function getBody(): array
    {
        return $this->collection;
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
     * 申报日期
     * Author:Robert
     *
     * @param string $date
     */
    public function setReportDate(string $date)
    {
        $this->params['sbrq'] = $this->reportDate = $date;

    }


    /**
     * 扣缴义务人(平台企业)信息
     * Author:Robert
     *
     * @param string $name 扣缴义务人识别号（社会信用代码）（平台企业）
     * @param string $licenseNo 扣缴义务人名称（平台企业）
     */
    public function setPlatformCompany(string $name, string $licenseNo)
    {
        $this->params['nsrmc'] = $this->companyName = $name;
        $this->params['nsrsbh '] = $this->companyLicenseNo = $licenseNo;
    }


}
