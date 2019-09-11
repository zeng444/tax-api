<?php

namespace Tax\Requests;

/**
 * 个人所得税详细信息接口
 * Author:Robert
 *
 * Class IndividualIncomeTaxSummaryRequest
 * @package Tax\Requests
 */
class IndividualIncomeTaxDetailRequest extends BaseRequest implements RequestInterface
{


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
    public $platformName;

    /**
     * @var
     */
    public $platformLicenseNo;

    /**
     * @var
     */
    public $platformIndustryCode;

    /**
     * @var
     */
    public $platformCityCode;

    /**
     * @var
     */
    public $platformAreaCode;

    /**
     * @var
     */
    public $revenueDepartment;

    /**
     * @var
     */
    public $taxPayer;

    /**
     * @var
     */
    public $taxPayerIdType;

    /**
     * @var
     */
    public $taxPayerIdNo;

    /**
     * @var
     */
    public $taxPayerCountryCode;

    /**
     * @var
     */
    public $taxPayerMobile;

    /**
     * @var
     */
    public $taxIncomeTotal;

    /**
     * @var
     */
    public $taxIncomeRate;

    /**
     * @var
     */
    public $taxBaseTotal;

    /**
     * @var
     */
    public $taxRate;

    /**
     * @var
     */
    public $deductedTotal;

    /**
     * @var
     */
    public $taxPayableTotal;

    /**
     * @var
     */
    public $taxPaidTotal;

    /**
     * @var
     */
    public $taxRefundedTotal;

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
     * 服务方唯一标识
     * Author:Robert
     *
     * @param string $uuid
     */
    public function setUUId(string $uuid)
    {
        $this->params['fwfuuid'] = $this->uuid = $uuid;
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
     * @param string string $industryCode 设置行业编码（营业执照）
     * @param string $cityCode （平台企业）-填写行政区划代码（市级），参见《行政区划代码-名称表》
     * @param string $areaCode 街道乡镇
     */
    public function setPlatformCompany(string $name, string $licenseNo, string $industryCode, string $cityCode, string $areaCode)
    {
        $this->params['nsrmc'] = $this->platformName = $name;
        $this->params['nsrsbh '] = $this->platformLicenseNo = $licenseNo;
        $this->params['hy'] = $this->platformIndustryCode = $industryCode;
        $this->params['xzqh'] = $this->platformCityCode = $cityCode;
        $this->params['jdxz'] = $this->platformAreaCode = $areaCode;
    }


    /**
     * 设置主管税务机关
     * Author:Robert
     *
     * @param string $department 主管税务所
     */
    public function setRevenue(string $department)
    {
        $this->params['swjg'] = $this->revenueDepartment = $department;
    }

    /**
     * 被代征人信息
     * Author:Robert
     *
     * @param string $name
     * @param string $idType
     * @param string $idNo
     * @param string $taxPayerMobile
     * @param string $countryCode
     */
    public function setTaxpayer(string $name, string $idType, string $idNo, string $taxPayerMobile, string $countryCode)
    {
        $this->params['sfzjlx'] = $this->taxPayerIdType = $idType;
        $this->params['sfzjhm'] = $this->taxPayerIdNo = $idNo;
        $this->params['xm'] = $this->taxPayer = $name;
        $this->params['gjdq'] = $this->taxPayerCountryCode = $countryCode;
        $this->params['lxdh'] = $this->taxPayerMobile = $taxPayerMobile;
    }


    /**
     * 应税收入
     * Author:Robert
     *
     * @param string $total 应税收入(自然人当年累计收入)
     * @param string $ratio 应税所得率（12%？一户一定）
     */
    public function setTaxIncomeTotal(string $total, string $ratio)
    {
        $this->params['yssr'] = $this->taxIncomeTotal = $total;
        $this->params['yssdl'] = $this->taxIncomeRate = $ratio;
    }

    /**
     * 计税依据
     * Author:Robert
     *
     * @param string $total 计税依据(应税收入*应税所得率)
     */
    public function setTaxBaseTotal(string $total)
    {
        $this->params['jsyj'] = $this->taxBaseTotal = $total;
    }


    /**
     * 税率
     * Author:Robert
     *
     * @param string $ratio
     */
    public function setTaxRate(string $ratio)
    {
        $this->params['sl'] = $this->taxRate = $ratio;
    }

    /**
     * 速算扣除数(生产经营所得)
     * Author:Robert
     *
     * @param string $total
     */
    public function setDeductedTotal(string $total)
    {
        $this->params['sskcs'] = $this->deductedTotal = $total;
    }

    /**
     * 应纳税额
     * Author:Robert
     *
     * @param string $total
     */
    public function setTaxPayableTotal(string $total)
    {
        $this->params['ynse'] = $this->taxPayableTotal = $total;
    }

    /**
     * 累计已缴纳税额
     * Author:Robert
     *
     * @param string $total
     */
    public function setTaxPaidTotal(string $total)
    {
        $this->params['ljyjse'] = $this->taxPaidTotal = $total;
    }


    /**
     * 本期应补退税额
     * Author:Robert
     *
     * @param string $total
     */
    public function setTaxRefundedTotal(string $total)
    {
        $this->params['bqybtse'] = $this->taxRefundedTotal = $total;
    }
}
