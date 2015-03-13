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
     * 
     * @param \Elaphure\Event\EventManager $eventManager
     * @return void
     */
    public function setEventManager(EventManager $eventManager);
    
    /**
     * @return \Elaphure\Event\EventManager
     */
    public function getEventManager();
    
    /**
     *
     * @param string $type
     * @param callable $listener
     * @param int $priority
     * @return void
     */
    public function addEventListener($type, callable $listener, $priority = 0);
    
    /**
     *
     * @param string $type
     * @param callable $listener
     * @return bool
     */
    public function removeEventListener($type, $listener);
    
    /**
     *
     * @param string $type
     * @return bool
     */
    public function hasEventListener($type);
    
    /**
     * 
     * @param string $type
     * @param mixed $params
     * @param bool $cancelable
     * @return \Elaphure\Event\Event|boolean
     */
    public function triggerEvent($type, $params = null, $cancelable = false);
    
    /**
     *
     * @param string $type
     * @param callback $listener
     * @param int $priority
     * @return void
     */
    public static function addStaticEventListener($type, callable $listener, $priority = 0);
    
    /**
     *
     * @param string $type
     * @param callable $listener
     * @return bool
     */
    public static function removeStaticEventListener($type, $listener);
    
    /**
     *
     * @param string $type
     * @return bool
     */
    public static function hasStaticEventListener($type);
}
