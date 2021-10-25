<?php


namespace Tengs\Douyin\Handler;


use Tengs\Douyin\Client\Client;
use Tengs\Douyin\User;

class FormDataHandler extends Handler
{
    public function post(User $user)
    {
        try {
            $res = (new Client())->formDataPost($this->getUrl(), $this->getQuery(), $this->getBody());
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
