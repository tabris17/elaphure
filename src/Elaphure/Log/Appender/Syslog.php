<?php
/**
 * Elaphurus Framework
 *
 * @link      https://github.com/tabris17/elaphurus
 * @license   Public Domain (http://en.wikipedia.org/wiki/Public_domain)
 */

namespace Elaphure\Log\Appender;

use Elaphure\Log\Exception\RuntimeException;
use Elaphure\Log\layout\LayoutAwareTrait;
use Elaphure\Log\layout\LayoutAwareInterface;

/**
 * Syslog 日志输出器
 */
class Syslog extends AbstractAppender implements LayoutAwareInterface
{
    use LayoutAwareTrait;
    
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Log\Appender\AbstractAppender::append()
     */
    public function append($logEvent)
    {
        if (false === syslog($priority, $this->getLayout()->handle($logEvent))) {
            throw new RuntimeException('syslog() return false');
        }
    }
}
