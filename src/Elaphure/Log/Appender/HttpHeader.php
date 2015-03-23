<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
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
