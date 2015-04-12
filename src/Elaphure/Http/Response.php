<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure\Http;

use Elaphure\Http\Response\Headers;
use Elaphure\Http\Exception\UnknownResponseStatus;
use Elaphure;
use Elaphure\Http\Response\Cookies;
use Elaphure\Http\Exception\UnknownProtocol;

/**
 * 响应类
 */
class Response
{
    /**
     * 响应状态码
     *  
     * @var int
     */
    protected $status;

    /**
     * 响应头部
     * 
     * @var \Elaphure\Http\Response\Headers
     */
    protected $headers;
    
    /**
     * Cookies
     * 
     * @var \Elaphure\Http\Response\Cookies
     */
    protected $cookies;
    
    /**
     * 响应本体
     * 
     * @var string
     */
    protected $body;

    /**
     * 服务器出错
     * 
     * 程序执行发生逻辑错误。
     * @const int
     */
    const STATUS_SERVER_ERROR = 500;
    
    /**
     * 服务不可用
     * 
     * 依赖的外部服务不可用。比如数据库宕机。
     * @const int
     */
    const STATUS_SERVICE_UNAVAILABLE = 503;
    
    /**
     * 请求错误
     * 
     * 提交的请求数据有错误。
     * @const int
     */
    const STATUS_BAD_REQUEST = 400;

    /**
     * 页面未找到
     *
     * @const int
     */
    const STATUS_NOT_FOUND = 404;
    
    /**
     * 禁止访问
     * 
     * @const int
     */
    const STATUS_FORBIDDEN = 403;
    
    /**
     * 正常
     * 
     * @const int
     */
    const STATUS_OK = 200;
    
    /**
     * 永久转移
     * 
     * @const int
     */
    const STATUS_MOVED_PERMANENTLY = 301;
    
    /**
     * 临时跳转
     * 
     * @const int
     */
    const STATUS_FOUND = 302;
    
    /**
     * HTTP 状态码消息
     * 
     * @var array
     */
    protected static $statusMessages = [
        100 => 'CONTINUE',
        101 => 'SWITCHING PROTOCOLS',
        102 => 'PROCESSING',
        200 => 'OK',
        201 => 'CREATED',
        202 => 'ACCEPTED',
        203 => 'NON-AUTHORITATIVE INFORMATION',
        204 => 'NO CONTENT',
        205 => 'RESET CONTENT',
        206 => 'PARTIAL CONTENT',
        207 => 'MULTI-STATUS',
        208 => 'ALREADY REPORTED',
        226 => 'IM USED',
        300 => 'MULTIPLE CHOICES',
        301 => 'MOVED PERMANENTLY',
        302 => 'FOUND',
        303 => 'SEE OTHER',
        304 => 'NOT MODIFIED',
        305 => 'USE PROXY',
        306 => 'RESERVED',
        307 => 'TEMPORARY REDIRECT',
        308 => 'PERMANENT REDIRECT',
        400 => 'BAD REQUEST',
        401 => 'UNAUTHORIZED',
        402 => 'PAYMENT REQUIRED',
        403 => 'FORBIDDEN',
        404 => 'NOT FOUND',
        405 => 'METHOD NOT ALLOWED',
        406 => 'NOT ACCEPTABLE',
        407 => 'PROXY AUTHENTICATION REQUIRED',
        408 => 'REQUEST TIMEOUT',
        409 => 'CONFLICT',
        410 => 'GONE',
        411 => 'LENGTH REQUIRED',
        412 => 'PRECONDITION FAILED',
        413 => 'REQUEST ENTITY TOO LARGE',
        414 => 'REQUEST-URI TOO LONG',
        415 => 'UNSUPPORTED MEDIA TYPE',
        416 => 'REQUESTED RANGE NOT SATISFIABLE',
        417 => 'EXPECTATION FAILED',
        418 => "I'M A TEAPOT",
        422 => 'UNPROCESSABLE ENTITY',
        423 => 'LOCKED',
        424 => 'FAILED DEPENDENCY',
        426 => 'UPGRADE REQUIRED',
        428 => 'PRECONDITION REQUIRED',
        429 => 'TOO MANY REQUESTS',
        431 => 'REQUEST HEADER FIELDS TOO LARGE',
        500 => 'INTERNAL SERVER ERROR',
        501 => 'NOT IMPLEMENTED',
        502 => 'BAD GATEWAY',
        503 => 'SERVICE UNAVAILABLE',
        504 => 'GATEWAY TIMEOUT',
        505 => 'HTTP VERSION NOT SUPPORTED',
        506 => 'VARIANT ALSO NEGOTIATES',
        507 => 'INSUFFICIENT STORAGE',
        508 => 'LOOP DETECTED',
        510 => 'NOT EXTENDED',
        511 => 'NETWORK AUTHENTICATION REQUIRED',
    ];

    /**
     * 
     * @param string $body 响应本体。
     * @param int $status 响应状态码。
     */
    public function __construct($body = '', $status = self::STATUS_OK)
    {
        $this->body = $body;
        $this->status = $status;
        $this->headers = new Headers();
        $this->cookies = new Cookies();
    }
    
    /**
     * 设置响应状态码
     * 
     * @param int $code 响应状态码。
     * @return void
     * @throws \Elaphure\Http\Exception\UnknownResponseStatus
     */
    public function setStatus($status)
    {
        $status = (int)$status;
        if (empty(self::$statusMessages[$status])) {
            throw new UnknownResponseStatus(
                sprintf(Elaphure::_('Unknown response status code "%s"'), $status)
            );
        }
        $this->status = $status;
    }
    
    /**
     * 获取响应状态码
     * 
     * @return int 返回当前响应状态码。
     */
    public function getStatus()
    {
        return $this->status;
    }
    
    /**
     * 获取响应头部对象
     * 
     * @return \Elaphure\Http\Response\Headers 返回响应头部对象。
     */
    public function getHeaders()
    {
        return $this->headers;
    }
    
    /**
     * 获取 Cookies 对象
     * 
     * @return \Elaphure\Http\Response\Cookies 返回 Cookies 对象。
     */
    public function getCookies()
    {
        return $this->cookies;
    }
    
    /**
     * 
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }
    
    /**
     * 
     * @param string $body
     * @return void
     */
    public function setBody($body)
    {
        $this->body = $body;
    }
    
    /**
     *
     * @param string $body
     * @return void 
     */
    public function appendBody($body)
    {
        $this->body .= $body;
    }
    
    /**
     * 重定向
     * 
     * @param string $url 重定向地址。
     * @param bool $permanently 是否永久转移。
     * @return void
     */
    public function redirect($url, $permanently = false)
    {
        $code = $permanently ? self::STATUS_MOVED_PERMANENTLY : self::STATUS_FOUND;
        $this->setStatus($code);
        $this->headers->set('Location', $url);
    }
    
    /**
     * 清空数据
     * 
     * 包括 Headers、Cookies、Body 和 HTTP 状态码。
     * @return void
     */
    public function clear()
    {
        $this->status = null;
        $this->headers->clear();
        $this->cookies->clear();
        $this->body = '';
    }

    /**
     * 发送响应
     * 
     * @return void
     */
    public function send()
    {
        if (!headers_sent()) {
            $status = $this->status;
            if (isset($status) && $status !== self::STATUS_OK) {
                http_response_code($status);
            }
            $this->headers->send();
            $this->cookies->send();
        }
        echo $this->body;
        $this->body = '';
    }
}
