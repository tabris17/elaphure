<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure\Log;

/**
 * 日志事件类
 */
class LogEvent
{
    /**
     * 
     * @var string
     */
    public $message;
    
    /**
     * 
     * @var int
     */
    public $level;
    
    /**
     * 
     * @var array
     */
    public $context;
    
    /**
     * 
     * @var \Elaphure\Timestamp
     */
    public $timestamp;
    
    /**
     * Constructor
     * 
     * @param int $level
     * @param string $message
     * @param array $context
     */
    public function __construct($level, $message, $context)
    {
        $this->level = $level;
        $this->message = $message;
        $this->context = $context;
        $this->timestamp = time();
    }
    
    public function getTimestamp()
    {
        return $this->timestamp;
    }
    
    public function getLevel()
    {
        return $this->level;
    }
    
    public function getLevelName()
    {
        return Level::getName($this->level);
    }
    
    public function getMessage()
    {
        return $this->message;
    }
    
    public function getContext()
    {
        return $this->context;
    }
}
