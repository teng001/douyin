<?php


namespace Tengs\Douyin\Handler;


class Handler
{
    /**
     * @var string $url
     */
    protected $url;

    /**
     * @var array $query
     */
    protected $query = [];

    /**
     * @var array $body
     */
    protected $body = [];

    /**
     * @var \Closure $successClosure
     */
    protected $successClosure;

    /**
     * @var \Closure $errorClosure
     */
    protected $errorClosure;


    /**
     * @param $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @param $query
     * @return $this
     */
    public function setQuery($query)
    {
        $this->query = $query;
        return $this;

    }

    /**
     * @param $body
     * @return $this
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @param \Closure $successClosure
     * @return $this
     */
    public function Success(\Closure $successClosure)
    {
        $this->successClosure = $successClosure;
        return $this;
    }

    /**
     * @param \Closure $errorClosure
     * @return $this
     */
    public function Error(\Closure $errorClosure)
    {
        $this->errorClosure = $errorClosure;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return array
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @return array
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param array $data
     */
    public function SuccessHandleClosure(array $data)
    {
        $success = $this->successClosure;
        $success($data);
    }

    /**
     * @param array $data
     */
    public function ErrorHandleClosure(array $data)
    {
        $error = $this->errorClosure;
        $error($data);
    }

}
