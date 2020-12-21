<?php 
return [
    'labels' => [
        'User' => 'User',
    ],
    'fields' => [
        'wx_nickname' => '微信名称',
        'wx_sex' => '微信用户的性别，值为1时是男性，值为2时是女性，值为0时是未知',
        'wx_province' => '微信用户的省份',
        'wx_city' => '微信用户的城市',
        'wx_country' => '微信用户的国家，如中国为CN',
        'wx_headimgurl' => '微信用户的头像，最后一个数值代表正方形头像大小（有0、46、64、96、132数值可选，0代表640*640正方形头像），用户没有头像时该项为空。若用户更换头像，原有头像URL将失效',
        'user_phone' => '用户电话',
        'user_email' => '用户邮箱',
        'user_name' => '用户真实姓名',
        'create_time' => '数据创建时间',
        'user_status' => '用户状态 ， 1-会员，0-非会员',
        'user_team' => '用户状态 ， 1-成对，0-非成对',
    ],
    'options' => [
    ],
];
