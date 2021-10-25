<?php


namespace Tengs\Douyin\Handler;


use Illuminate\Support\Facades\Cache;
use Tengs\Douyin\Client\Client;
use Tengs\Douyin\Exceptions\ClientException;

class UniversalHandler extends Handler
{
    protected function getClientToken()
    {
        if (!Cache::has('douyin_client_token')) {
            $res = (new Client())->get('/oauth/client_token/', [
                'client_key' => config('douyin.client_key'),
                'client_secret' => config('douyin.client_secret'),
                'grant_type' => 'client_credential']);
            if ($res['data']['error_code'] != 0) {
                ClientException::throwError('获取client_token失败 error_code:' . $res['data']['error_code'] . ' description:' . $res['data']['description']);
            }
            Cache::put('douyin_client_token', $res['data']['access_token'], now()->addSeconds($res['data']['expires_in']));
            return $res['data']['access_token'];
        }
        return Cache::get('douyin_client_token');
    }


    public function get()
    {
        try {
            $query['access_token'] = $this->getClientToken();
            $res = (new Client())->get($this->getUrl(), array_merge($this->getQuery(), $query));
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
