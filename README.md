# 抖音平台接口sdk

## 通过composer安装

1、配置config-》app.php

```
providers=>[
        \Tengs\Douyin\ServiceProvider::class,
]
```

2、发布配置

```php
$ php artisan vendor:publish --provider='Tengs\Douyin\ServiceProvider'
```

3、env

```
DOUYIN_CLIENT_KEY=
DOUYIN_CLIENT_SECRET=
```

4、配置回调地址 config-》douyin.php

callback_route参数路由名称配置回调

## 获取授权用户

```
        $user=Tengs\Douyin\User::make();
        $user->getAccessToken();//获取token
        $user->getOpenId();//获取open_id
        $user->getExpand();//获取用户全部信息
```

## 创建视频

````
        $videoData = [
        'multipart' => [
                [
                    'Content-Disposition' => 'form-data',
                    'Content-Type' => 'video/mp4',
                    'name' => 'video',
                    'filename' => '1.mp4',
                    'contents' => file_get_contents(storage_path('1.mp4'))
                ]
            ]
        ];
        $video_id = '';
        $mediasHandler->setUrl('/video/upload/')->setBody($videoData)->Success(function ($data) use (&$video_id) {
                $video_id = $data['video']['video_id'];
            })->Error(function ($data) {
                //上传失败
            })->video($user);
        
        (new AuthHandler())->setUrl('/video/create/')
        ->setBody(['video_id' => $video_id])
        ->Success(function ($data) {
            //创建成功
        })->Error(function ($data) {
           //创建失败
        })->post($user);
````
