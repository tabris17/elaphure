<?php 
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure\Event;

use Elaphure\Util\PriorityList;
use Elaphure\Event\Exception\InvalidArgumentException;

/**
 * 事件管理器
 */
class EventManager
{
    /**
     * 事件监听器列表
     * 
     * @var array
     */
    protected $listeners = [];

    /**
     * 派发事件
     * 
     * @param \Elaphure\Event\Event $event
     * @param string $type
     * @return bool
    */
    public function dispatchEvent($event, $type)
    {
        if (empty($this->listeners[$type])) {
            return false;
        }
        $priorityList = $this->listeners[$type];
        foreach ($priorityList as $listener) {
            if (is_array($listener)) {
                call_user_func($listener, $event);
            } else {
                $listener($event);
            }
            if ($event->isPropagationStopped()) {
                break;
            }
        }
        return true;
    }
    
    /**
     * 添加事件监听器
     * 
     * @param string $type
     * @param callable $listener
     * @param int $priority
     * @return void
     * @throws \Elaphure\Event\Exceptoin\InvalidArgumentException
     */
    public function addEventListener($type, callable $listener, $priority)
    {
        if (empty($this->listeners[$type])) {
            $this->listeners[$type] = $priorityList = new PriorityList();
        } else {
            $priorityList = $this->listeners[$type];
        }
        $priorityList->insert($listener, $priority);
    }
    
    /**
     * 移除事件监听器
     * 
     * @param string $type
     * @param callable $listener
     * @return bool
     */
    public function removeEventListener($type, $listener)
    {
        if (empty($this->listeners[$type])) {
            return false;
        }
        $priorityList = $this->listeners[$type];
        return $priorityList->remove($listener);
    }
    
    /**
     * 查询是否有事件监听器
     * 
     * @param string $type
     * @return bool
     */
    public function hasEventListener($type)
    {
        return isset($this->listeners[$type]);
    }
}
