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
 * 日志依赖接口
 */
interface LoggerAwareInterface
{
    /**
     * 为对象设置日志记录器
     *
     * @param \Elaphure\Log\LoggerInterface $logger
     * @return void
     */
    public function setLogger(LoggerInterface $logger);
    
    /**
     * 获取日志记录器对象
     * 
     * @return \Elaphure\Log\LoggerInterface
     */
    public function getLogger();
}
