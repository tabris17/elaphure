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
 * 事件类
 */
class Event
{
    /**
     * 产生事件的目标对象
     * 
     * @var object
     */
    protected $target;
    
    /**
     * 事件类型
     * 
     * @var string
     */
    protected $type;
    
    /**
     * 是否可以取消事件的默认行为
     * 
     * @var bool
     */
    protected $cancelable;
    
    /**
     * 事件附带参数
     * 
     * @var mixed
     */
    protected $params;
    
    private $canceled = false;
    private $stopped = false;
    
    /**
     * 获取事件附带参数
     * 
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }
    
    /**
     * 获取产生事件的目标对象
     * 
     * @return object
     */
    public function getTarget()
    {
        return $this->target;
    }
    
    /**
     * 获取事件类型
     * 
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * 阻止事件默认行为
     * 
     * @return void
     */
    public function preventDefault()
    {
        if ($this->cancelable) {
            $this->canceled = true;
        }
    }
    
    /**
     * 是否可以取消事件的默认行为
     * 
     * @return bool
     */
    public function isDefaultPrevented()
    {
        return $this->canceled;
    }
    
    /**
     * 阻止事件冒泡
     * 
     * @return void
     */
    public function stopPropagation()
    {
        $this->stopped = true;
    }
    
    /**
     * 是否已阻止事件冒泡
     * 
     * @return bool
     */
    public function isPropagationStopped()
    {
        return $this->stopped;
    }
    
    /**
     * 
     * @param object $target
     * @param string $type
     * @param mixed $params
     * @param bool $cancelable
     */
    public function __construct($target, $type, $params, $cancelable)
    {
        $this->target = $target;
        $this->type = $type;
        $this->params = $params;
        $this->cancelable = $cancelable;
    }
}
