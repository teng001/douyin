<?php


namespace Tengs\Douyin\Handler;


use Tengs\Douyin\Client\Client;
use Tengs\Douyin\User;

class AuthHandler extends Handler
{
    public function get(User $user)
    {
        try {
            $query['open_id'] = $user->getOpenId();
            $query['access_token'] = $user->getAccessToken();
            $query = array_merge($this->getQuery(), $query);
            $res = (new Client())->get($this->getUrl(), $query);
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

    public function post(User $user)
    {
        try {
            $query['open_id'] = $user->getOpenId();
            $query['access_token'] = $user->getAccessToken();
            $query = array_merge($this->getQuery(), $query);
            $res = (new Client())->post($this->getUrl(), $query, $this->getBody());
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
