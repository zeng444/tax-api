<?php

namespace Tax\Requests\ReportRequest;

use Tax\Requests\BaseRequest;

/**
 * Author:Robert
 *
 * Class Collection
 * @package Tax\Requests\ReportRequest
 */
class Collection extends BaseRequest
{




    /**
     * 征收项目
     * Author:Robert
     *
     * @param string $taxType
     */
    public function setTaxType(string $taxType)
    {
        $this->params['zsxm'] = $taxType;
    }

    /**
     * 征收品目
     * Author:Robert
     *
     * @param string $taxCategory
     */
    public function setTaxCategory(string $taxCategory)
    {
        $this->params['zspm'] = $taxCategory;
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
     * 计税依据
     * Author:Robert
     *
     * @param string $total 当月收入/1.03>=10万（无税时计税依据=当月收入/1.03，有税时计税依据=当月收入/1.03）
     */
    public function serTaxBaseTotal(string $total)
    {
        $this->params['jsyj'] = $total;
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
        $this->params['slhse'] = $ratio;
    }

    /**
     * 应纳税额
     * Author:Robert
     *
     * @param $total
     */
    public function setTaxPayableTotal($total)
    {
        $this->params['ynse'] = $total;
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
        $this->params['jmse'] = $total;
        $this->params['jmxz'] = $type;
    }

    /**
     * 已缴税额
     * Author:Robert
     *
     * @param string $total
     */
    public function setTaxPaid(string $total)
    {
        $this->params['yjse'] = $total;
    }

    /**
     * 应代征税额
     * Author:Robert
     *
     * @param string $total
     */
    public function setAgentTaxChargeableTotal(string $total)
    {
        $this->params['ydzse'] = $total;
    }

    /**
     * 已代征税额
     * Author:Robert
     *
     * @param string $total
     */
    public function setAgentTaxPaidTotal(string $total)
    {
        $this->params['sdzse'] = $total;
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
        $this->params['sybz'] = $sign;
        $this->params['sybh'] = $code;
        $this->params['syzl'] = $position;
    }
}
