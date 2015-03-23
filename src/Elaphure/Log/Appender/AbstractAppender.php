<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure\Log\Appender;

use Elaphure\Log\AppenderInterface;

/**
 * 日志输出器抽象类
 */
abstract class AbstractAppender implements AppenderInterface
{
    /**
     * 输出器是否已经启动
     * 
     * @var bool
     */
    protected $isStarted = false;
    
    /**
     * 安装过滤器
     * 
     * @param \Elaphure\Log\Filter\AbstractFilter $filter
     * @return \Elaphure\Log\AppenderInterface 返回新的日志输出器接口。
     */
    public function addFilter($filter)
    {
        $filter->setAppender($this);
        return $filter;
    }

    /**
     * (non-PHPdoc)
     * @see \Elaphure\Log\AppenderInterface::start()
     */
    public function start()
    {
        $this->isStarted = true;
    }

    /**
     * (non-PHPdoc)
     * @see \Elaphure\Log\AppenderInterface::stop()
     */
    public function stop()
    {
        $this->isStarted = false;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Log\AppenderInterface::isStarted()
     */
    public function isStarted()
    {
        return $this->isStarted;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Log\AppenderInterface::append()
     */
    abstract public function append($logEvent);
}
