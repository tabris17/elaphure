<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure\Log\Filter;

/**
 * 闭包过滤器类
 */
class Closure extends AbstractFilter
{
    private $closure;
    
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Log\Filter\AbstractFilter::filter()
     */
    public function filter($logEvent)
    {
        if ($this->closure instanceof \Closure) {
            return $this->closure($logEvent);
        }
        return true;
    }
    
    /**
     * 绑定闭包
     * 
     * 由于 PHP 不支持闭包序列化，所以闭包必须在运行时绑定。
     * 
     * @param \Closure $closure
     * @return null
     */
    public function bind($closure)
    {
        $this->closure = $closure;
    }
}
