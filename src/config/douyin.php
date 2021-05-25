<?php

return [
    'client_key' => env('DOUYIN_CLIENT_KEY'),
    'client_secret' => env('DOUYIN_CLIENT_SECRET'),
    'scope' => [
        'user_info',//获取用户信息
        'fans.list',//获取粉丝信息
        'following.list',//获取关注信息

        'video.create',//创建视频
        'video.delete',//删除视频
        'video.list',//授权账号视频列表
        'video.data',//查询指定视频数据
//            'toutiao.video.create',//头条创建视频
//            'toutiao.video.data',//头条授权账号视频列表
//            'xigua.video.create',//西瓜创建视频
//            'xigua.video.data',//西瓜授权账号视频列表

//            'item.comment',//用户号评论
//            'video.comment',//企业号评论
        'enterprise.im',//企业号私信用户
        'enterprise.data',//企业号私信用户

//            'video.search',//关键词视频搜索
//            'data.external.user',//获取用户视频数据情况
//            'data.external.item',//获取视频数据情况
//            'fans.data',//获取粉丝数据
//            'data.external.fans_source',//获取用户粉丝来源分布
//            'data.external.fans_favourite',//获取用户粉丝喜好
    ],
    'route' => [
        'uri' => 'serve',
        'action' => Tengs\Douyin\Controllers\DouYinAuthorizationController::class,
        'attributes' => [
            'prefix' => '',
            'middleware' => 'web',
            'namespace' => 'Tengs\\Douyin\\Controllers'
        ],
        'callback_route' => 'douyin.user'
    ]
];
