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
 * HTTP 头部
 */
class Header
{
    private $name;
    private $value;
    
    /**
     * 
     * @param string $name 头部名称。
     * @param string $value 头部值。
     */
    public function __construct($name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }
    
    /**
     * 获取头部名称
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * 获取头部值
     * 
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * 获取头部完整行
     * 
     * @return string
     */
    public function toString()
    {
        return $this->name . ': ' . $this->value;
    }
}
