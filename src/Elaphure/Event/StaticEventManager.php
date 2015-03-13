<?php 
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure;

/**
 * 静态事件管理器
 */
class StaticEventManager extends EventManager
{
    /**
     * 静态事件管理器实例
     * 
     * @var \Elaphure\Event\StaticEventManager
     */
    protected static $instance;
    
    /**
     * 单例模式获取静态事件管理器对象实例
     * 
     * @return \Elaphure\Event\StaticEventManager
     */
    public static function getInstance()
    {
        if (isset(self::$instance)) {
            return self::$instance;
        }
        return self::$instance = new self();
    }
}
