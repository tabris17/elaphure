<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure\Http\Response;

class Cookies
{
    /**
     * Cookies
     * 
     * @var array
     */
    protected $cookies = [];

    /**
     * 设置 Cookie
     *
     * @param string $name 键名。
     * @param string $value 保存的值。
     * @param int $expire 过期时间。单位为秒。如果是 0，表示 Cookie 在浏览器会话结束后过期。
     * @param string $path 对应的服务器路径。
     * @param string $domain 对应的域名。
     * @param string $isSecure 如果为 true，则只有当前连接为 HTTPS 时才传送 Cookie。
     * @param string $httpOnly 如果为 true，则 Cookie 不允许浏览器脚本访问。
     * @return void
     */
    public function set($name, $value, $expire = 0, $path = null, $domain = null, $isSecure = false, $httpOnly = false)
    {
        $this->cookies[$name] = [$value, (int)$expire, $path, $domain, $isSecure, $httpOnly]; 
    }
    
    /**
     * 移除 Cookie
     *
     * @param string $name Cookie 名称。
     * @return bool 如果返回 false，表示未设置该名称的 Cookie。
     */
    public function remove($name)
    {
        $retVal = isset($this->cookies[$name]);
        unset($this->cookies[$name]);
        return $retVal;
    }
    
    /**
     * Cookie 是否存在
     * 
     * @param string $name Cookie 名称。
     * @return bool 
     */
    public function has($name)
    {
        return isset($this->cookies[$name]);
    }
    
    /**
     * 清除所有已设置的 Cookie
     * 
     * @return void
     */
    public function clear()
    {
        $this->cookies = [];
    }
    
    /**
     * 获取 Cookie 的值
     * 
     * @param string $name
     * @return string 如果 Cookie 不存在返回 NULL。
     */
    public function getValue($name)
    {
        if (isset($this->cookies[$name])) {
            list($value) = $this->cookies[$name];
            return $value;
        }
    }
    
    /**
     * 获取 Cookie 的有效期
     * 
     * @param string $name
     * @return int 如果 Cookie 不存在返回 NULL。
     */
    public function getExpire($name)
    {
        if (isset($this->cookies[$name])) {
            list(, $expire) = $this->cookies[$name];
            return $expire;
        }
    }
    
    /**
     * 获取 Cookie 的路径
     * 
     * @param string $name
     * @return string 如果 Cookie 不存在返回 NULL。
     */
    public function getPath($name)
    {
        if (isset($this->cookies[$name])) {
            list(, , $path) = $this->cookies[$name];
            return $path;
        }
    }
    
    /**
     * 获取 Cookie 的域名
     * 
     * @param string $name
     * @return string 如果 Cookie 不存在返回 NULL。
     */
    public function getDomain($name)
    {
        if (isset($this->cookies[$name])) {
            list(, , , $domain) = $this->cookies[$name];
            return $domain;
        }
    }
    
    /**
     * 获取 Cookie 是否为 HTTPS 传输
     * 
     * @param string $name
     * @return bool 如果 Cookie 不存在返回 NULL。
     */
    public function isSecure($name)
    {
        if (isset($this->cookies[$name])) {
            list(, , , , $isSecure) = $this->cookies[$name];
            return (bool)$isSecure;
        }
    }
    
    /**
     * 获取 Cookie 是否禁止脚本访问
     * 
     * @param string $name
     * @return bool 如果 Cookie 不存在返回 NULL。
     */
    public function isHttpOnly($name)
    {
        if (isset($this->cookies[$name])) {
            list(, , , , , $isHttpOnly) = $this->cookies[$name];
            return (bool)$isHttpOnly;
        }
    }
    
    /**
     * 发送 Cookies
     * 
     * @return void
     */
    public function send()
    {
        foreach ($this->cookies as $name => list($_1, $_2, $_3, $_4, $_5, $_6)) {
            setcookie($name, $_1, $_2, $_3, $_4, $_5, $_6);
        }
        $this->cookies = [];
    }
}
