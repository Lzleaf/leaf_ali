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
    public function aliPayOrderData($url,$subject,$out_trade_no,$price,$desc = ''){
        $ali_pay = new AliPayOrderData();
        $ali_pay->setService('mobile.securitypay.pay');
        $ali_pay->setPartner();
        $ali_pay->setInputCharset('utf-8');
        $ali_pay->setSignType('RSA');
        $ali_pay->setProductCode('QUICK_MSECURITY_PAY');
        $ali_pay->setNotifyUrl(urlencode($url));
        $ali_pay->setSubject($subject);
        $ali_pay->setPayment_type(1);
        $ali_pay->setOut_trade_no($out_trade_no);
        $ali_pay->setSeller_id();
        $ali_pay->setTotal_fee($price);
        $ali_pay->setBody($desc);

        $str = $ali_pay->argSort($ali_pay->values);
        return $str;
    }
}