<?php
namespace AppPay;

class AliPayOrderData
{

    protected $config;

    public function __construct()
    {
        $this->config = new AliPayConfig();
    }

    public $values = array();

    public function setService($value)
    {
        $this->values['service'] = $value;
    }

    public function setPartner()
    {
        $this->values['partner'] = $this->config->partner;
    }

    public function setInputCharset($value)
    {
        $this->values['_input_charset'] = $value;
    }

    public function setSignType($value)
    {
        $this->values['sign_type'] = $value;
    }

    public function setNotifyUrl($value)
    {
        $this->values['notify_url'] = $value;
    }

    public function setProductCode($value)
    {
        $this->values['product_code'] = $value;
    }

    public function setOut_trade_no($value)
    {
        $this->values['out_trade_no'] = $value;
    }

    public function setSubject($value)
    {
        $this->values['subject'] = $value;
    }

    public function setPayment_type($value)
    {
        $this->values['payment_type'] = $value;
    }

    public function setSeller_id()
    {
        $this->values['seller_id'] = $this->config->partner;
    }

    public function setTotal_fee($value)
    {
        $this->values['total_fee'] = $value;
    }

    public function setBody($value)
    {
        $this->values['body'] = $value;
    }

    public function argSort($ali)
    {
        ksort($ali);
        reset($ali);
        $str = '';
        foreach ($ali as $key => $val) {
            if ($key == 'sign_type' || $key == 'sign' || $val == '') {
                continue;
            } else {
                if ($str == '') {
                    $str = $key . '=' . '"' . $val . '"';
                } else {
                    $str = $str . '&' . $key . '=' . '"' . $val . '"';
                }
            }
        }
        $sign = urlencode($this->sign($str));
        $msg = $str.'&sign='.'"'.$sign.'"'.'&sign_type='.'"'."RSA".'"';
        return $msg;
    }

    protected function sign($data)
    {
        //读取私钥文件
        $priKey = file_get_contents($this->config->private_key_path);//私钥文件路径
        //转换为openssl密钥，必须是没有经过pkcs8转换的私钥
        $res = openssl_get_privatekey($priKey);
        //调用openssl内置签名方法，生成签名$sign
        openssl_sign($data, $sign, $res);
        //释放资源
        openssl_free_key($res);
        //base64编码
        $sign = base64_encode($sign);
        return $sign;
    }
}