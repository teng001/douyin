<?php


namespace Tengs\Douyin\Handler;


use Tengs\Douyin\Client\Client;
use Tengs\Douyin\User;

class RefreshTokenHandler extends Handler
{
    public function post(User $user)
    {
        try {
            $body['client_key'] = config('douyin.client_key');
            $body['grant_type'] = 'refresh_token';
            $body['refresh_token'] = $user->getExpand()['refresh_token'];
            $res = (new Client())->formDataPost($this->getUrl(), [], $body);
            if ($res['data']['error_code'] != 0) {
                $this->ErrorHandleClosure($res);
            } else {
                $this->SuccessHandleClosure($res['data']);
            }
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
