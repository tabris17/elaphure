<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure\Http\Response;

/**
 * 响应头部
 */
class Headers
{
    /**
     * Headers
     * 
     * @var array
     */
    protected $headers = [];

    /**
     * 设置头部
     * 
     * @param string $name 头部名称。
     * @param string $value 头部值。
     * @param bool $replace 在同名头部名称已设置的情况下，如果是 true，则替换原有头部，否则新增一个同名头部。
     * @return void
     */
    public function set($name, $value, $replace = true)
    {
        if (isset($this->headers[$name])) {
            if ($replace) {
                $this->headers[$name] = $value;
            } else {
                $origiValue = $this->headers[$name];
                if (is_array($origiValue)) {
                    $this->headers[$name][] = $value;
                } else {
                    $this->headers[$name] = [$origiValue, $value];
                }
            }
        } else {
            $this->headers[$name] = $value;
        }
    }
    
    /**
     * 移除头部
     * 
     * @param string $name 头部名称。
     * @return bool 如果返回 false，表示未设置该名称的头部。
     */
    public function remove($name)
    {
        $retVal = isset($this->headers[$name]);
        unset($this->headers[$name]);
        return $retVal;
    }
    
    /**
     * 获取已设置的头部
     * 
     * @param string $name 头部名称。
     * @return string|array 返回设置的头部值。如果设置了个多个值则返回一个数组。如果未设置值则返回 NULL。
     */
    public function get($name)
    {
        if (isset($this->headers[$name])) {
            return $this->headers[$name];
        }
    }
    
    /**
     * 头部是否存在
     * 
     * @param string $name 头部名称。
     * @return bool 
     */
    public function has($name)
    {
        return isset($this->headers[$name]);
    }
    
    /**
     * 清除所有已设置的头部
     * 
     * @return void
     */
    public function clear()
    {
        $this->headers = [];
    }

    /**
     * 发送头部到客户端
     * 
     * @return void
     */
    public function send()
    {
        foreach ($this->headers as $name => $value) {
            if (is_array($value)) {
                foreach ($value as $item) {
                    header("$name: $item", false);
                }
            } else {
                header("$name: $value");
            }
        }
    }
}
