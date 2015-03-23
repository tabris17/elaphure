<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure\Log\Filter;

use Elaphure\Log\AppenderInterface;

/**
 * 过滤器抽象类
 */
abstract class AbstractFilter implements AppenderInterface
{
    /**
     * 日志输出器
     * 
     * @var \Elaphure\Log\AppenderInterface
     */
    protected $appender = null;
    
    /**
     * 设置被过滤的日志输出器对象
     * 
     * @param \Elaphure\Log\AppenderInterface $appender
     * @return null
     */
    public function setAppender(AppenderInterface $appender)
    {
        $this->appender = $appender;
    }
    
    /**
     * 获取被过滤的日志输出器对象
     *
     * @return \Elaphure\Log\AppenderInterface
     */
    public function getAppender()
    {
        return $this->appender;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Log\AppenderInterface::append()
     */
    public function append($logEvent)
    {
        if ($this->filter($logEvent)) {
            return $this->appender->append($logEvent);
        }
    }
    
    /**
     * 过滤日志事件
     * 
     * @param \Elaphure\Log\LogEvent $logEvent
     * @return bool 返回日志事件是否通过过滤器。
     */
    abstract public function filter($logEvent);
    
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Log\AppenderInterface::start()
     */
    public function start()
    {
        return $this->appender->start();
    }
    
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Log\AppenderInterface::stop()
     */
    public function stop()
    {
        return $this->appender->stop();
    }
    
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Log\AppenderInterface::isStarted()
     */
    public function isStarted()
    {
        return $this->appender->isStarted();
    }
}
