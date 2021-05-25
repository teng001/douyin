<?php


namespace Tengs\Douyin\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Tengs\Douyin\Client\Client;
use Tengs\Douyin\Handler\AuthHandler;
use Tengs\Douyin\Handler\MediasHandler;
use Tengs\Douyin\User;

class DouYinAuthorizationController
{
    public function code(Request $request)
    {
        $scopeArr = $request->input('scope');
        $state = $request->input('state');
        $scopeArr = $scopeArr ? Arr::wrap($scopeArr) : config('douyin.scope');
        $client_key = config('douyin.client_key'); // string | 应用唯一标识
        $response_type = config('douyin.client_secret');; // string | 填写code
        $scope = join(',', $scopeArr); // string | 应用授权作用域,多个授权作用域以英文逗号（,）分隔
        $redirect_uri = route('douyin.callback'); // string | 授权成功后的回调地址，必须以http/https开头。域名必须对应申请应用时填写的域名，如不清楚请联系应用申请人。
        $url = 'https://open.douyin.com/platform/oauth/connect/?';
        $url = $url . http_build_query(compact('client_key', 'response_type', 'scope', 'redirect_uri', 'state'));
        return redirect($url);
    }

    public function token(Request $request)
    {
        $client_key = config('douyin.client_key'); // string | 应用唯一标识
        $client_secret = config('douyin.client_secret');; // string | 填写code
        $code = $request->input('code');
        $grant_type = 'authorization_code';
        $state = $request->input('state');
        $res = (new Client())->get('/oauth/access_token/', compact('client_key', 'client_secret', 'code', 'grant_type'));
        if ($res['data']['error_code'] != 0) {
            return response('获取token失败 error_code:' . $res['data']['error_code'] . ' description:' . $res['data']['description']);
        }
        session()->put('douyin_auth', array_merge($res['data'], ['state' => $state]));
        return redirect()->route(config('douyin.route.callback_route'))->send();
    }

    public function user(AuthHandler $authHandler, MediasHandler $mediasHandler)
    {
        $user = User::make();
//        $videoData = [
//            'multipart' => [
//                [
//                    'Content-Disposition' => 'form-data',
//                    'Content-Type' => 'video/mp4',
//                    'name' => 'video',
//                    'filename' => '1.mp4',
//                    'contents' => file_get_contents(storage_path('1.mp4'))
//                ]
//            ]
//        ];
//        $video_id = '';
//        $mediasHandler->setUrl('/video/upload/')->setBody($videoData)->Success(function ($data) use (&$video_id) {
//            $video_id = $data['video']['video_id'];
//        })->Error(function ($data) {
//            dd('上传失败', $data);
//        })->video($user);

//        (new AuthHandler())->setUrl('/video/create/')
//            ->setBody(['video_id' => $video_id])
//            ->Success(function ($data) {
//
//            })
//            ->Error(function ($data) {
//                dd('创建失败', $data);
//            })
//            ->post($user);

        $videoData = [
            'multipart' => [
                [
                    'Content-Disposition' => 'form-data',
                    'Content-Type' => 'video/mp4',
                    'name' => 'image',
                    'filename' => '1.png',
                    'contents' => file_get_contents(storage_path('1.png'))
                ]
            ]
        ];
        $image_id = '';
        $mediasHandler->setUrl('/image/upload/')->setBody($videoData)->Success(function ($data) use (&$image_id) {
            $image_id = $data['image']['image_id'];
        })->Error(function ($data) {
            dd('上传失败', $data);
        })->video($user);

        (new AuthHandler())->setUrl('/image/create/')
            ->setBody(['image_id' => $image_id])
            ->Success(function ($data) {
                dd('创建成功');
            })
            ->Error(function ($data) {
                dd('创建失败', $data);
            })
            ->post($user);


//        $authHandler->setUrl('/video/list/')->setQuery(['count' => 20])
//            ->Success(function ($data) {
//                dd($data);
//            })
//            ->Error(function ($data) {
//                dd('获取列表失败', $data);
//            })->get($user);
    }
}
