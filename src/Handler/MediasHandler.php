<?php


namespace Tengs\Douyin\Handler;


use Tengs\Douyin\Client\Client;
use Tengs\Douyin\User;

class MediasHandler extends Handler
{

    public function video(User $user)
    {
        try {
            $query['open_id'] = $user->getOpenId();
            $query['access_token'] = $user->getAccessToken();
            $res = (new Client())->postUpload($this->getUrl(), array_merge($this->getQuery(),$query), $this->getBody());
            if ($res['data']['error_code'] != 0) {
                $this->ErrorHandleClosure($res);
            }
            $this->SuccessHandleClosure($res['data']);
        } catch (\Throwable $exception) {
            $res = [
                'data' => [
                    'description' => '请求异常' . $exception->getMessage(),
                    'error_code' => '-10086'
                ]
            ];
            $this->ErrorHandleClosure($res);
        }
    }

    public function image(User $user)
    {
        try {
            $query['open_id'] = $user->getOpenId();
            $query['access_token'] = $user->getAccessToken();
            $res = (new Client())->postUpload($this->getUrl(), array_merge($this->getQuery(),$query), $this->getBody());
            if ($res['data']['error_code'] != 0) {
                $this->ErrorHandleClosure($res);
            }
            $this->SuccessHandleClosure($res['data']);
        } catch (\Throwable $exception) {
            $res = [
                'data' => [
                    'description' => '请求异常' . $exception->getMessage(),
                    'error_code' => '-10086'
                ]
            ];
            $this->ErrorHandleClosure($res);
        }
    }
}
