<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure\Event;

/**
 * 事件依赖接口
 */
interface EventAwareInterface
{
    /**
     * 设置事件管理器
     * 
     * @param \Elaphure\Event\EventManager $eventManager
     * @return void
     */
    public function setEventManager(EventManager $eventManager);
    
    /**
     * 获取事件管理器
     * 
     * @return \Elaphure\Event\EventManager
     */
    public function getEventManager();
    
    /**
     * 添加事件监听器
     * 
     * @param string $type 事件类型。
     * @param callable $listener 事件监听器。
     * @param int $priority 在监听队列中的权重。
     * @return void
     */
    public function addEventListener($type, callable $listener, $priority = 0);
    
    /**
     * 移除事件监听器
     * 
     * @param string $type 事件类型。
     * @param callable $listener 事件监听器。
     * @return bool 返回执行是否成功。
     */
    public function removeEventListener($type, $listener);
    
    /**
     * 查询事件类型是否有监听器
     * 
     * @param string $type 事件类型。
     * @return bool 返回是否存在。
     */
    public function hasEventListener($type);
    
    /**
     * 触发事件
     * 
     * @param string $type 事件类型。
     * @param mixed $params 事件附带参数。
     * @param bool $cancelable 是否可以阻止事件默认行为。
     * @return \Elaphure\Event\Event|boolean 如果没有任何监听函数则返回 false，否则返回事件对象。
     */
    public function triggerEvent($type, $params = null, $cancelable = false);
    
    /**
     * 添加静态事件监听器
     * 
     * 静态事件监听器可以监听到该类所有实例产生的事件。
     * @param string $type 事件类型。
     * @param callback $listener 事件监听器。
     * @param int $priority 在监听队列中的权重。
     * @return void
     */
    public static function addStaticEventListener($type, callable $listener, $priority = 0);
    
    /**
     * 移除静态事件监听器
     * 
     * @param string $type 事件类型。
     * @param callable $listener 事件监听器。
     * @return bool 返回执行是否成功。
     */
    public static function removeStaticEventListener($type, $listener);
    
    /**
     * 查询事件类型是否有静态事件监听器
     * 
     * @param string $type 事件类型。
     * @return bool 返回是否存在。
     */
    public static function hasStaticEventListener($type);
}
