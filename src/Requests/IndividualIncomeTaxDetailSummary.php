<?php

namespace Tax\Requests;

/**
 * 个人所得税汇总信息接口
 * Author:Robert
 *
 * Class IndividualIncomeTaxSummaryRequest
 * @package Tax\Requests
 */
class IndividualIncomeTaxDetailSummary extends BaseRequest implements RequestInterface
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
    public $companyName;

    /**
     * @var
     */
    public $companyLicenseNo;

    /**
     * @var
     */
    public $taxRate;

    /**
     * @var
     */
    public $peopleQuantity;

    /**
     * @var
     */
    public $taxIncomeTotal;

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
        return 'postSdsxx0001';
    }

    /**
     * Author:Robert
     *
     * @return string
     */
    public function getNodeName(): string
    {
        return 'sdshzxx';
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
        return [$this->params];
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
        $this->params['nsrsbh'] = $this->companyLicenseNo = $licenseNo;
    }

    /**
     * 税率
     * Author:Robert
     *
     * @param string $ratio （5 %、10%、20%、30%、35%）
     */
    public function setTaxRate(string $ratio)
    {
        $this->params['sl'] = $this->taxRate = $ratio;
    }


    /**
     * 申报人数
     * Author:Robert
     *
     * @param string $number
     */
    public function setPeopleQuantity(string $number)
    {
        $this->params['sbrs'] = $this->peopleQuantity = $number;
    }

    /**
     * 应税收入
     * Author:Robert
     *
     * @param string $total
     */
    public function setTaxIncomeTotal(string $total)
    {
        $this->params['yssr'] = $this->taxIncomeTotal = $total;
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
        $this->params['ljyjnse'] = $this->taxPaidTotal = $total;
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
