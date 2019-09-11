<?php

namespace Tax\Requests\IndividualIncomeTaxSummaryRequest;

use Tax\Requests\BaseRequest;

/**
 * Author:Robert
 *
 * Class Collection
 * @package Tax\Requests\IndividualIncomeTaxSummaryRequest
 */
class Collection extends BaseRequest
{

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
     * @return bool
     */
    public function validate(): bool
    {
        //        $this->setMessage('something wrong');
        return true;
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
