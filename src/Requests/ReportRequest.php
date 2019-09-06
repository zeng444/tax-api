<?php

namespace Tax\Requests;

use Tax\Requests\ReportRequest\Collection;

/**
 * 平台企业基础信息接口
 * Author:Robert
 *
 * Class ReportRequest
 * @package Tax\Requests
 */
class ReportRequest extends BaseRequest implements RequestInterface
{


    protected $collection = [];

    /**
     * @var
     */
    public $taxPayerCompanyName;

    /**
     * @var
     */
    public $taxPayerIdNo;

    /**
     * @var
     */
    public $taxPayerCompanyLicenseNo;

    /**
     * @var
     */
    public $taxpayerIdTypeCode;

    /**
     * @var
     */
    public $industryCode;

    /**
     * @var
     */
    public $taxpayerCountryNo;

    /**
     * @var
     */
    public $taxpayerUuid;


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
     * 服务方唯一标识
     * Author:Robert
     *
     * @param string $uuid
     */
    public function setTaxpayerUUId(string $uuid)
    {
        $this->params['fwfuuid'] = $this->taxpayerUuid = $uuid;
    }


    /**
     * Author:Robert
     *
     * @param string $name 被代征单位纳税人名称（被代征人的姓名）
     * @param string $companyLicenseNo 被代征单位纳税人识别号（被代征人的身份证号）
     */
    public function setTaxpayerCompany(string $name, string $companyLicenseNo = '')
    {
        $this->params['bdzdwnsrmc'] = $this->taxPayerCompanyName = $name;
        $this->params['bdzdwnsrsbh'] = $this->taxPayerCompanyLicenseNo = $companyLicenseNo;
    }

    /**
     * 被代征人信息
     * Author:Robert
     *
     * @param string $idNo 被代征人的身份证号
     * @param string $idTypeCode 被代征人证件类型
     * @param string $countryNo 国家或地区-填写被代征人国家地区代码，参见《申报表-计税excel页签：国家和地区代码》
     */
    public function setTaxpayer(string $idNo, string $idTypeCode = '201', string $countryNo = '156')
    {
        $this->params['zjhm'] = $this->taxPayerIdNo = $idNo;
        $this->params['zjlx'] = $this->taxpayerIdTypeCode = $idTypeCode;
        $this->params['gjhdq'] = $this->taxpayerCountryNo = $countryNo;
    }

    /**
     * 所属行业
     * Author:Robert
     *
     * @param string $industryCode （-填写平台企业所在行业代码，参见《行业代码-名称表》）
     */
    public function setTaxIndustryCode(string $industryCode)
    {
        $this->params['sshy'] = $this->industryCode = $industryCode;
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
        $this->params['skssqq'] = $startDate;
        $this->params['skssqz'] = $endDate;
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
