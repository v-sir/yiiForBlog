<?php
/**
 * Created by PhpStorm.
 * User: huangwei
 * Date: 5/25/17
 * Time: 5:33 PM
 */
$postdata=array(
    'opt'

);
$url="https://shenghuo.alipay.com/send/payment/submit.htm";
$ch = curl_init();//新建curl
curl_setopt($ch, CURLOPT_URL, $url);//url
curl_setopt($ch, CURLOPT_POST, 1);  //post
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);//post内容
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
$a = curl_exec($ch);


?>