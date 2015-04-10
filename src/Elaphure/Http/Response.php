<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure\Http;

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
     * @var unknown
     */
    protected $headers;
    
    /**
     * 响应本体
     * 
     * @var string
     */
    protected $body;
    
    /**
     * Cookie 集合
     * 
     * @var unknown
     */
    protected $cookies;

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
    public function __construct($body, $status = self::STATUS_OK)
    {
        $this->body = $body;
        $this->status = $status;
    }
    
    public function getHeaders()
    {
        //return 
    }
    
    /**
     * 设置响应状态码
     * 
     * @param int $code 响应状态码。
     * @return bool 返回执行是否成功。
     */
    public function setStatus($code)
    {
        return $code == http_response_code($code);
    }
    
    /**
     * 获取响应状态码
     * 
     * @return int 返回当前响应状态码。
     */
    public function getStatus()
    {
        return http_response_code();
    }    
    
    public function sendFile($filename, $attachmentName = null)
    {
        
    }
    
    public function send()
    {
        
    }
    
    public function setHeader($name, $value)
    {
        
    }
    
    /**
     * HTTP 头部是否已经发送
     * 
     * @return bool 返回 true 则说明 HTTP 头部已经发生，无法使用 setHeader 方法来添加头部信息。
     */
    public function isHeadersSent()
    {
        return headers_sent();
    }
    
    public function getContent()
    {
        
    }
    
    public function setContent()
    {
        
    }
    
    public function appendContent()
    {
        
    }
    
    /**
     * 设置 Cookie
     * 
     * @param string $name 键名。
     * @param string $value 保存的值。
     * @param int $exprie 过期时间。单位为秒。如果是 0，表示 Cookie 在浏览器会话结束后过期。
     * @param string $path 对应的服务器路径。
     * @param string $domain 对应的域名。
     * @param string $isSecure 如果为 true，则只有当前连接为 HTTPS 时才传送 Cookie。
     * @param string $httpOnly 如果为 true，则 Cookie 不允许浏览器脚本访问。
     * @return bool 成功则返回 true；如果响应数据已经发送，则返回 false。
     */
    public function setCookie($name, $value, 
        $exprie = 0, $path = null, $domain = null, $isSecure = false, $httpOnly = false)
    {
        return setcookie($name, $value, $exprie, $path, $domain, $isSecure, $httpOnly);
    }
    
    /**
     * 删除 Cookie
     * 
     * @param string $name 键名。
     * @return bool 成功则返回 true；如果响应数据已经发送，则返回 false。
     */
    public function removeCookie($name)
    {
        return $this->setCookie($name, null, 1);
    }
    
    /**
     * 重定向
     * 
     * @param string $url 重定向地址。
     * @param bool $permanently 是否永久转移。
     * @return bool 返回执行是否成功。
     */
    public function redirect($url, $permanently = false)
    {
        $code = $permanently ? self::STATUS_MOVED_PERMANENTLY : self::STATUS_FOUND;
        $this->setStatus($code);
        return header('Location: ' . $url);
    }
}
