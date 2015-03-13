<?php
/**
 * Elaphurus Framework
 *
 * @link      https://github.com/tabris17/elaphurus
 * @license   Public Domain (http://en.wikipedia.org/wiki/Public_domain)
 */

namespace Elaphure\Log\Appender;

use Elaphure\Log\layout\LayoutAwareTrait;
use Elaphure\Log\Layout\LayoutAwareInterface;

/**
 * 不输出任何信息
 */
class HttpHeader extends AbstractAppender implements LayoutAwareInterface
{
    use LayoutAwareTrait;

    /**
     * (non-PHPdoc)
     * @see \Elaphure\Log\Appender\AbstractAppender::append()
     */
    public function append($logEvent)
    {
        header('Log:' . $this->getLayout()->handle($logEvent));
    }
}
