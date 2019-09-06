<?php

namespace Tax\Requests\IndividualIncomeTaxRequest;

use Tax\Requests\BaseRequest;

/**
 * Author:Robert
 *
 * Class Collection
 * @package Tax\Requests\IndividualIncomeTaxRequest
 */
class Collection extends BaseRequest
{

    /**
     * @var
     */
    public $taxCategory;

    /**
     * @var
     */
    public $taxTypeCode;

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
    public $taxPayableTotal;

    /**
     * @var
     */
    public $taxReducedTotal;

    /**
     * @var
     */
    public $taxReducedType;

    /**
     * @var
     */
    public $taxPaidTotal;

    /**
     * @var
     */
    public $agentTaxChargeableTotal;

    /**
     * @var
     */
    public $agentTaxPaidTotal;

    /**
     * @var
     */
    public $taxOriginSign;

    /**
     * @var
     */
    public $taxOriginCode;

    /**
     * @var
     */
    public $taxOriginPosition;

    /**
     * 增值税
     */
    const ADD_VALUE_TAX_CODE = '10101';

    /**
     * 印花税
     */
    const STAMP_TAX_CODE = '10111';

    /**
     * 城建费
     */
    const CITY_BUILDING_TAX_CODE = '10109';

    /**
     * 教育附加税
     */
    const EDUCATION_ADDITIONAL_TAX_CODE = '30203';

    /**
     * 本地教育附加税
     */
    const LOCAL_EDUCATION_ADDITIONAL_TAX_CODE = '30216';

    const TAX_TYPE_MAP = [
        self::ADD_VALUE_TAX_CODE => '增值税',
        self::STAMP_TAX_CODE => '印花税',
        self::CITY_BUILDING_TAX_CODE => '城建费',
        self::EDUCATION_ADDITIONAL_TAX_CODE => '教育附加税',
        self::LOCAL_EDUCATION_ADDITIONAL_TAX_CODE => '本地教育附加税',
    ];

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
     * 征收项目
     * Author:Robert
     *
     * @param string $taxTypeCode
     * @throws \Exception
     */
    public function setTaxType(string $taxTypeCode)
    {

        if (!in_array($taxTypeCode, array_keys(self::TAX_TYPE_MAP))) {
            throw  new \Exception('不合法的征收项目');
        }
        $this->params['zsxm'] = $this->taxTypeCode = $taxTypeCode;
    }

    /**
     * 征收品目
     * Author:Robert
     *
     * @param string $taxCategory
     */
    public function setTaxCategory(string $taxCategory)
    {
        $this->params['zspm'] = $this->taxCategory = $taxCategory;
    }


    /**
     * 计税依据
     * Author:Robert
     *
     * @param string $total 当月收入/1.03>=10万（无税时计税依据=当月收入/1.03，有税时计税依据=当月收入/1.03）
     */
    public function serTaxBaseTotal(string $total)
    {
        $this->params['jsyj'] = $this->taxBaseTotal = $total;
    }

    /**
     * 税率或税额
     * Author:Robert
     *
     * @param string $ratio 按各税种执行：增值税3%
     * 运输印花税万分之五、技术印花税万分之三（印花税跟局方确认）
     * 城建税7%
     * 教育费附加3%
     * 地方教育附加 2%\
     */
    public function serTaxRate(string $ratio)
    {
        $this->params['slhse'] = $this->taxRate = $ratio;
    }

    /**
     * 应纳税额
     * Author:Robert
     *
     * @param $total
     */
    public function setTaxPayableTotal($total)
    {
        $this->params['ynse'] = $this->taxPayableTotal = $total;
    }

    /**
     * 减免额度
     * Author:Robert
     *
     * @param string $total 有税申报时：减免税额=0，无税申报时：减免税额 = 应纳税额
     * @param string $type 减免性质（减免代码）
     */
    public function setTaxReducedTotal(string $total, string $type = '')
    {
        $this->params['jmse'] = $this->taxReducedTotal = $total;
        $this->params['jmxz'] = $this->taxReducedType = $type;
    }

    /**
     * 已缴税额
     * Author:Robert
     *
     * @param string $total 一般为0
     */
    public function setTaxPaidTotal(string $total)
    {
        $this->params['yjse'] = $this->taxPaidTotal = $total;
    }

    /**
     * 应代征税额
     * Author:Robert
     *
     * @param string $total
     */
    public function setAgentTaxChargeableTotal(string $total)
    {
        $this->params['ydzse'] = $this->agentTaxChargeableTotal = $total;
    }

    /**
     * 已代征税额
     * Author:Robert
     *
     * @param string $total 一般为0
     */
    public function setAgentTaxPaidTotal(string $total)
    {
        $this->params['sdzse'] = $this->agentTaxPaidTotal = $total;
    }

    /**
     * 税源标志
     * Author:Robert
     *
     * @param string $sign 税源标志
     * @param string $code 税源编号
     * @param string $position 税源坐落
     */
    public function setTaxOrigin(string $sign, string $code, string $position)
    {
        $this->params['sybz'] = $this->taxOriginSign = $sign;
        $this->params['sybh'] = $this->taxOriginCode = $code;
        $this->params['syzl'] = $this->taxOriginPosition = $position;
    }
}
