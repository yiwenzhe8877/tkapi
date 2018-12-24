<?php


$domain='http://localhost/yiiapi/server/';

return [
    'adminEmail' => 'admin@example.com',
    'page_size' => '20',
    'salt'=>'zz515',
    'cache_token_time'=>30,
    'domain'=>$domain,
    'img_path'=>$domain.'data/images/',
    'table_prefix'=>"ssc_",
    'token'=>"token",
    'middle_token'=>"token",
    'member_token'=>"token",
    'cus_jiesuan_user'=>[
        "0-0.9999999999999999999"=>0.55,
        "1-1.9999999999999999999"=>0.55,
        "2-2.9999999999999999999"=>0.54,
        "3-4.9999999999999999999"=>0.54,
        "5-9.9999999999999999999"=>0.54,
        "10-29.9999999999999999999"=>0.53,
        "30-9999999999999999999"=>0.52,
    ],
    'user_group'=>[
        '1'=>'消费者',
        '2'=>'vip会员',
        '3'=>'运营商'
    ]

];
