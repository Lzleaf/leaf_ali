<?php
/**
 * Created by PhpStorm.
 * User: leaf
 * Date: 2017/3/20
 * Time: 下午3:21
 */

namespace AppPay;


class AliAppPay
{
    protected $ali_pay;
    public function __construct(AliPayOrderData $ali_pay)
    {
        $this->ali_pay = $ali_pay;
    }
    public function aliPayOrderData($url,$subject,$out_trade_no,$price,$desc = ''){
        
        $this->ali_pay->setService('mobile.securitypay.pay');
        $this->ali_pay->setPartner();
        $this->ali_pay->setInputCharset('utf-8');
        $this->ali_pay->setSignType('RSA');
        $this->ali_pay->setProductCode('QUICK_MSECURITY_PAY');
        $this->ali_pay->setNotifyUrl(urlencode($url));
        $this->ali_pay->setSubject($subject);
        $this->ali_pay->setPayment_type(1);
        $this->ali_pay->setOut_trade_no($out_trade_no);
        $this->ali_pay->setSeller_id();
        $this->ali_pay->setTotal_fee($price);
        $this->ali_pay->setBody($desc);

        $str = $this->ali_pay->argSort($this->ali_pay->values);
        return $str;
    }
}