<?php
/**
 * Elaphurus Framework
 *
 * @link      https://github.com/tabris17/elaphurus
 * @license   Public Domain (http://en.wikipedia.org/wiki/Public_domain)
 */

namespace Elaphure\Log\Appender;

use Elaphure\Log\layout\LayoutAwareTrait,
    Elaphure\Log\layout\LayoutAwareInterface;

/**
 * 输出日志到控制台
 */
class Console extends AbstractAppender implements LayoutAwareInterface
{
    use LayoutAwareTrait;
    
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Log\Appender\AbstractAppender::append()
     */
    public function append($logEvent)
    {
        echo $this->getLayout()->handle($logEvent), PHP_EOL;
    }
}
