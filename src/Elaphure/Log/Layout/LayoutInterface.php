<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure\Log\Layout;

/**
 * 日志布局接口
 */
interface LayoutInterface
{
    /**
     * 处理 LogEvent 对象
     * 
     * @param \Elaphure\Log\LogEvent $logEvent
     * @return string
     */
    public function handle($logEvent);
}
