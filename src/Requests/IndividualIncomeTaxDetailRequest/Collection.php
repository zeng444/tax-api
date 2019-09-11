<?php

namespace Tax\Requests\IndividualIncomeTaxDetailRequest;

use Tax\Requests\BaseRequest;

/**
 * Author:Robert
 *
 * Class Collection
 * @package Tax\Requests\IndividualIncomeTaxDetailRequest
 */
class Collection extends BaseRequest
{

    /**
     * @var
     */
    public $taxPayer;

    /**
     * @var
     */
    public $taxPayerProvince;

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
     * @var
     */
    public $uuid;

    /**
     * Author:Robert
     *
     * @return bool
     */
    public function validate(): bool
    {
        //        $this->setMessage('something wrong');
        return true;
    }


    /**
     * 服务方唯一标识
     * Author:Robert
     *
     * @param string $uuid
     */
    public function setUUID(string $uuid)
    {
        $this->params['fwfuuid'] = $this->uuid = $uuid;
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
     * @param string $taxPayerProvince 自然人默认填写东疆行政区划
     */
    public function setTaxpayer(string $name, string $idType, string $idNo, string $taxPayerMobile, string $countryCode, string $taxPayerProvince)
    {
        $this->params['sfzjlx'] = $this->taxPayerIdType = $idType;
        $this->params['sfzjhm'] = $this->taxPayerIdNo = $idNo;
        $this->params['xm'] = $this->taxPayer = $name;
        $this->params['gjdq'] = $this->taxPayerCountryCode = $countryCode;
        $this->params['lxdh'] = $this->taxPayerMobile = $taxPayerMobile;
        $this->params['scjydxzqh'] = $this->taxPayerProvince = $taxPayerProvince;
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

    /**
     * Author:Robert
     *
     * @return array
     */
    public function getBody(): array
    {
        return $this->params;
    }
}
