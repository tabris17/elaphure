<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure\Http;

use Elaphure\Http\Request\File as UploadedFile;
use Elaphure\Http\Exception\UploadError;

/**
 * HTTP 请求类
 */
class Request
{
    /**
     * 请求头部
     * 
     * @var array
     */
    protected $headers;
    
    /**
     * $_COOKIE
     *
     * @var array
     */
    protected $cookie;
    
    /**
     * $_GET
     * 
     * @var array
     */
    protected $get;
    
    /**
     * $_POST
     * 
     * @var array
     */
    protected $post;
    
    /**
     * $_FILES
     * 
     * @var array
     */
    protected $files;
    
    /**
     * $_REQUEST
     *
     * @var array
     */
    protected $request;
    
    /**
     * $_SERVER
     * 
     * @var array
     */
    protected $server;

    /**
     * 请求的方法
     *
     * $_SERVER['REQUEST_METHOD']
     * @var string
     */
    protected $method;
    
    /**
     * 请求查询字符串
     *
     * $_SERVER['QUERY_STRING']
     * @var string
     */
    protected $queryString;
    
    /**
     * 请求路径
     * 
     * $_SERVER['REQUEST_URI']
     * @var string
     */
    protected $uri;
    
    /**
     * 请求发起的时间戳
     * 
     * $_SERVER['REQUEST_TIME_FLOAT']
     * @var float
     */
    protected $timestamp;
    
    /**
     * $_SERVER['PATH_INFO']
     * @var string
     */
    protected $pathInfo;
    
    /**
     * HTTP Scheme
     * 
     * $_SERVER['REQUEST_SCHEME']
     * @var string
     */
    protected $scheme;
    
    /**
     * 是否为 HTTPS 请求
     * 
     * @var bool
     */
    protected $isHttps;
    
    /**
     * 请求正体
     * 
     * @var string
     */
    protected $body;
    
    /**
     * 
     * @param array $request
     * @param array $get
     * @param array $post
     * @param array $cookie
     * @param array $server
     * @param array $files
     */
    public function __construct($request, $get, $post, $cookie, $files, $server)
    {
        $this->request = $request;
        $this->get = $get;
        $this->post = $post;
        $this->files = $files;
        $this->cookie = $cookie;
        $this->server = $server;
        $this->method = $server['REQUEST_METHOD'];
        $this->queryString = $server['QUERY_STRING'];
        $this->uri = $server['REQUEST_URI'];
        $this->timestamp = $server['REQUEST_TIME_FLOAT'];
        $this->pathInfo = $server['PATH_INFO'];
    }
    
    /**
     * 获取GET请求参数
     * 
     * @param string $name 参数名称。
     * @param string $default 默认值。
     * @return mixed 返回参数的值。
     */
    public function getQuery($name, $default = null)
    {
        $get = $this->get;
        if (isset($get[$name])) {
            return $get[$name];
        }
        return $default;
    }
    
    /**
     * 获取请求的查询字符串
     * 
     * @return string 返回请求的查询字符串。
     */
    public function getQueryString()
    {
        return $this->queryString;
    }
    
    /**
     * 获取POST请求参数
     * 
     * @param string $name 参数名称。
     * @param string $default 默认值。
     * @return mixed 返回参数的值。
     */
    public function getPost($name, $default = null)
    {
        $post = $this->post;
        if (isset($post[$name])) {
            return $post[$name];
        }
        return $default;
    }
    
    /**
     * 获取 Cookie 数据
     *
     * @param string $name Cookie 名称。
     * @return mixed 返回 Cookie 数据。
     */
    public function getCookie($name, $default = null)
    {
        $cookie = $this->cookie;
        if (isset($cookie[$name])) {
            return $cookie[$name];
        }
        return $default;
    }

    /**
     * 获取请求头部
     *
     * @param string $name 头部名称。
     * @return string 返回头部信息。
     */
    public function getHeader($name, $default = null)
    {
        $name = 'HTTP_' . strtoupper(str_replace('-', '_', $name));
        if (isset($this->server[$name])) {
            return isset($this->server[$name]);
        }
        return $default;
    }
    
    /**
     * 获取客户端的IP地址
     * 
     * @return string 返回客户端的 IP 地址。
     */
    public function getRemoteAddress()
    {
        return $this->server['REMOTE_ADDR'];
    }
    
    /**
     * 获取客户端的端口号
     *
     * @return string 返回客户端的端口号。
     */
    public function getRemotePort()
    {
        return $this->server['REMOTE_PORT'];
    }
    
    /**
     * 获取请求方法
     * 
     * @return string 返回请求方法。
     */
    public function getMethod()
    {
        return $this->method;
    }
    
    /**
     * 是否为 POST 请求
     * 
     * @return bool
     */
    public function isPost()
    {
        return $this->method === 'POST';
    }
    
    /**
     * 是否为 GET 请求
     *
     * @return bool
     */
    public function isGet()
    {
        return $this->method === 'GET';
    }
    
    /**
     * 是否为 PUT 请求
     *
     * @return bool
     */
    public function isPut()
    {
        return $this->method === 'PUT';
    }
    
    /**
     * 是否为 PATCH 请求
     *
     * @return bool
     */
    public function isPatch()
    {
        return $this->method === 'PATCH';
    }
    
    /**
     * 是否为 DELETE 请求
     *
     * @return bool
     */
    public function isDelete()
    {
        return $this->method === 'DELETE';
    }
    
    /**
     * 是否为 HEAD 请求
     *
     * @return bool
     */
    public function isHead()
    {
        return $this->method === 'HEAD';
    }
    
    /**
     * 是否为 OPTIONS 请求
     *
     * @return bool
     */
    public function isOptions()
    {
        return $this->method === 'OPTIONS';
    }
    
    /**
     * 是否存在请求参数
     * 
     * @param string $name 参数名称。
     * @return bool 如果存在则返回 true，否则返回 false。
     */
    public function has($name)
    {
        return isset($this->request[$name]);
    }
    
    /**
     * 是否存在 POST 参数
     *
     * @param string $name 参数名称。
     * @return bool 如果存在则返回 true，否则返回 false。
     */
    public function hasPost($name)
    {
        return isset($this->post[$name]);
    }
    
    /**
     * 是否存在 GET 参数
     *
     * @param string $name 参数名称。
     * @return bool 如果存在则返回 true，否则返回 false。
     */
    public function hasQuery($name)
    {
        return isset($this->get[$name]);
    }

    /**
     * 是否存在 Cookie 数据
     *
     * @param string $name Cookie 名称。
     * @return bool 如果存在返回 true，否则返回 false。
     */
    public function hasCookie($name)
    {
        return isset($this->cookie[$name]);
    }
    
    /**
     * 是否存在上传文件
     * 
     * @param string $name 参数名称。
     * @return bool 如果存在则返回 true，否则返回 false。
     */
    public function hasFile($name)
    {
        return isset($this->files[$name]);
    }

    /**
     * 是否存在头部
     *
     * @param string $name 请求头部名称。
     * @return bool 如果存在则返回 true，否则返回 false。
     */
    public function hasHeader($name)
    {
        $name = 'HTTP_' . strtoupper(str_replace('-', '_', $name));
        return isset($this->server[$name]);
    }
    
    /**
     * 获取单个上传文件
     * 
     * @param string $name 参数名称。
     * @param bool $throwOnError 当上传文件有错误时是否抛出异常。
     * @return \Elaphure\Http\Request\File 返回上传文件对象。如果包含多个上传文件或文件不存在则返回 NULL。
     */
    public function getFile($name, $throwOnError = false)
    {
        $files = $this->files;
        if (empty($files[$name])) {
            return;
        }

        $uploadedFileArray = $files[$name];
        
        $filename = $uploadedFileArray['name'];
        $type = $uploadedFileArray['type'];
        $tempName = $uploadedFileArray['tmp_name'];
        $size = $uploadedFileArray['size'];
        $error = $uploadedFileArray['error'];
        
        if (is_array($filename)) {
            return;
        }
        
        if ($throwOnError && $error !== UPLOAD_ERR_OK) {
            throw new UploadError($error);
        }
        
        return new UploadedFile($name, $filename, $type, $tempName, $size, $error);
    }
    
    /**
     * 获取多个上传文件
     *
     * @param string $name 参数名称。
     * @param bool $ignoreError 如果为 true，则有错误的上传文件不会出现在结果里。
     * @return \Elaphure\Http\Request\File[] 返回一个数组包含多个上传文件对象。数组可能是空的。
     */
    public function getFiles($name, $ignoreError = false)
    {
        $files = $this->files;
        if (empty($files[$name])) {
            return [];
        }
        
        $uploadedFileArray = $files[$name];
        
        $filenames = $uploadedFileArray['name'];
        $types = $uploadedFileArray['type'];
        $tempNames = $uploadedFileArray['tmp_name'];
        $sizes = $uploadedFileArray['size'];
        $errors = $uploadedFileArray['error'];
        
        if (is_string($filenames)) {
            if ($ignoreError && $errors !== UPLOAD_ERR_OK) {
                return [];
            }
            return [new UploadedFile(
                $name, 
                $filenames, 
                $types, 
                $tempNames, 
                $sizes, 
                $errors
            )];
        }
        
        $uploadFiles = [];
        
        foreach ($filenames as $i => $filename) {
            $error = $errors[$i];
            if ($ignoreError && $error !== UPLOAD_ERR_OK) {
                continue;
            }

            $uploadFiles[] = new UploadedFile(
                $name,
                $filename, 
                $types[$i], $tempNames[$i], $sizes[$i],
                $error
            );
        }
        
        return $uploadFiles;
    }
    
    /**
     * 推测 HTTP Scheme
     * 
     * @return void
     */
    protected function inferScheme()
    {
        if (isset($server['REQUEST_SCHEME'])) {
            $this->scheme = $server['REQUEST_SCHEME'];
            $this->isHttps = ($this->scheme === 'https');
        } elseif (isset($server['HTTPS'])) {
            $this->isHttps = (!empty($https = $server['HTTPS']) && $https !== 'off');
            $this->scheme = $this->isHttps ? 'https' : 'http';
        } else {
            // 不可靠的推断方式
            if ($server['SERVER_PORT'] == 443) {
                $this->isHttps = true;
                $this->scheme = 'https';
            } else {
                $this->isHttps = false;
                $this->scheme = 'http';
            }
        }
    }
    
    /**
     * 获取 HTTP Scheme
     * 
     * @return string 如果是 HTTPS 请求返回 "https"，否则返回 "http"。
     */
    public function getScheme()
    {
        if (empty($this->scheme)) {
            $this->inferScheme();
        }
        return $this->scheme;
    }
    
    /**
     * 是否为 HTTPS 请求
     * 
     * @return bool 如果是 HTTPS 请求则返回 true，否则返回 false。
     */
    public function isHttps()
    {
        if (empty($this->isHttps)) {
            $this->inferScheme();
        }
        return $this->isHttps;
    }
    
    /**
     * 获取 HTTP 协议版本
     * 
     * @return string 返回 "HTTP/1.0" 或者 "HTTP/1.1"。
     */
    public function getProtocol()
    {
        return $this->server['SERVER_PROTOCOL'];
    }
    
    /**
     * 获取请求的完整 URL 地址
     * 
     * @return string 返回请求的完整 URL 地址。形如：http://host:port/path/file.ext
     */
    public function getFullUrl()
    {
        return $this->getScheme() . '://' . $this->getHost(). $this->getUri();
    }
    
    /**
     * 获取服务器名称
     * 
     * @return sting 返回服务器名称。
     */
    public function getServerName()
    {
        return $this->server['SERVER_NAME'];
    }
    
    /**
     * 获取服务器端口号
     *
     * @return sting 返回服务器端口号。
     */
    public function getServerPort()
    {
        return $this->server['SERVER_PORT'];
    }
    
    /**
     * 获取服务器 IP 地址
     *
     * @return sting 返回服务器 IP 地址。
     */
    public function getServerAddress()
    {
        return $this->server['SERVER_ADDR'];
    }

    /**
     * 获取请求的 URI
     * 
     * @return string 返回请求的 URI。
     */
    public function getUri()
    {
        return $this->uri;
    }
    
    /**
     * 获取脚本名称
     * 
     * @return string
     */
    public function getScriptName()
    {
        return $this->server['SCRIPT_NAME'];
    }
    
    /**
     * 获取脚本文件名
     * 
     * @return string
     */
    public function getScriptFilename()
    {
        return $this->server['SCRIPT_FILENAME'];
    }

    /**
     * 获取请求的时间戳
     *
     * @return float 返回请求的时间戳。
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * 获取请求消耗的时间
     *
     * @return float 返回请求消耗的时间。单位为秒。
     */
    public function getSpentTime()
    {
        return microtime(true) - $this->getTimestamp();
    }

    /**
     * 获取 PATH_INFO
     * 
     * @return string
     */
    public function getPathInfo()
    {
        return $this->pathInfo;
    }
    
    /**
     * 获取请求的所有头部
     * 
     * @return array 返回请求的所有头部。
     */
    public function getHeaders()
    {
        if (isset($this->headers)) {
            return $this->headers;
        }
        foreach ($this->server as $name => $value) {
            if (substr($name, 0, 5) === 'HTTP_') {
                $this->headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $this->headers = $headers;
    }
    
    /**
     * 获取请求的 HOST 头部
     * 
     * @return 返回请求的 HOST 头部。
     */
    public function getHost()
    {
        return $this->getHeader('Host');
    }
    
    /**
     * 获取浏览器 User-Agent 标识
     * 
     * @return string 返回浏览器 User-Agent 标识。
     */
    public function getUserAgent()
    {
        return $this->getHeader('User-Agent');
    }
    
    /**
     * 获取代理路径
     * 
     * @return string 返回代理路径。
     */
    public function getXForwardedFor()
    {
        return $this->getHeader('X-Forwarded-For');
    }

    /**
     * 是否为 Ajax 请求
     *
     * @return bool
     */
    public function isAjax()
    {
        return $this->getHeader('X-Requested-With') === "XMLHttpRequest";
    }

    /**
     * 获取引用来源地址
     *
     * @return bool 返回引用来源地址。
     */
    public function getReferer()
    {
        $this->getHeader('Referer');
    }

    /**
     * 获取请求正体
     * 
     * 如果 POST 表单是 enctype="multipart/form-data"，则该方法无法获取数据。
     * @return string 返回请求正体。
     */
    public function getBody()
    {
        if ($this->body === null) {
            $body = @file_get_contents('php://input');
            $this->body = ($body === false) ? '' : $body;
        }
        return $this->body;
    }
}
