<?php


namespace Tengs\Douyin\Client;


use GuzzleHttp\Exception\GuzzleException;
use Tengs\Douyin\Exceptions\ClientException;

class Client
{
    protected $host = 'https://open.douyin.com';

    /**
     * @param string $url
     * @param array $query
     * @return array
     * @throws ClientException
     */
    public function get(string $url, array $query = []): array
    {
        try {
            $res = (new \GuzzleHttp\Client())->get($this->host . $url, ['headers' => ['Content-Type' => 'application/json'], 'query' => $query]);
            if ($res->getStatusCode() != 200) {
                ClientException::throwError('请求异常' . $res->getBody()->getContents());
            }
            return json_decode($res->getBody(), true);
        } catch (GuzzleException $exception) {
            ClientException::throwError($exception->getMessage());
        }
    }

    /**
     * @param string $url
     * @param array $query
     * @param array $body
     * @return mixed
     * @throws ClientException
     */
    public function post(string $url, array $query = [], array $body = [])
    {
        try {
            $res = (new \GuzzleHttp\Client())->post($this->host . $url, ['headers' => ['Content-Type' => 'application/json'], 'query' => $query, 'json' => $body]);
            if ($res->getStatusCode() != 200) {
                ClientException::throwError('请求异常' . $res->getBody()->getContents());
            }
            return json_decode($res->getBody(), true);
        } catch (GuzzleException $exception) {
            ClientException::throwError($exception->getMessage());
        }
    }

    /**
     * @param string $url
     * @param array $query
     * @param array $body
     * @return mixed
     * @throws ClientException
     */
    public function postUpload(string $url, array $query = [], array $body = [])
    {
        try {
            $res = (new \GuzzleHttp\Client())->post($this->host . $url, array_merge($body, ['query' => $query]));
            if ($res->getStatusCode() != 200) {
                ClientException::throwError('请求异常' . $res->getBody()->getContents());
            }
            return json_decode($res->getBody(), true);
        } catch (GuzzleException $exception) {
            ClientException::throwError($exception->getMessage());
        }
    }

    /**
     * @param string $url
     * @param array $query
     * @param array $body
     * @return mixed
     * @throws ClientException
     */
    public function formDataPost(string $url, array $query = [], array $body = [])
    {
        try {
            $res = (new \GuzzleHttp\Client())->post($this->host . $url, array_merge($body, ['query' => $query]));
            if ($res->getStatusCode() != 200) {
                ClientException::throwError('请求异常' . $res->getBody()->getContents());
            }
            return json_decode($res->getBody(), true);
        } catch (GuzzleException $exception) {
            ClientException::throwError($exception->getMessage());
        }
    }
}
