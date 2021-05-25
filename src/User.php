<?php


namespace Tengs\Douyin;


class User
{
    protected $access_token;
    protected $open_id;
    protected $scope;
    protected $state;
    protected $expand;

    public function __construct(array $info = [])
    {
        $info = $info ?: session()->get('douyin_auth');
        $this->access_token = $info['access_token'] ?? '';
        $this->open_id = $info['open_id'] ?? '';
        $this->scope = $info['scope'] ?? '';
        $this->state = $info['state'] ?? '';
        $this->expand = $info;
    }

    /**
     * @param array $info
     * @return User
     */
    static public function make(array $info = [])
    {
        return new self($info);
    }

    /**
     * @return mixed|string
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * @return mixed|string
     */
    public function getOpenId()
    {
        return $this->open_id;
    }

    /**
     * @return mixed|string
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @return mixed|string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * other
     * @return array|mixed
     */
    public function getExpand()
    {
        return $this->expand;
    }

}
