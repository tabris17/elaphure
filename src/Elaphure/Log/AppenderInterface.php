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
 * 日志输出器接口
 */
interface AppenderInterface
{
    /**
     * 输出日志
     * 
     * @param \Elaphure\Log\LogEvent $logEvent
     * @return void
     */
    public function append($logEvent);

    /**
     * 开启输出器
     * 
     * @return void
     */
    public function start();
    
    /**
     * 停止输出器
     * 
     * @return void
     */
    public function stop();
    
    /**
     * 返回输出器开启状态
     * 
     * @return bool
     */
    public function isStarted();
}
