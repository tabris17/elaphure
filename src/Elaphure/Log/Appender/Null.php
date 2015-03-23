<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure\Log\Appender;

/**
 * 不输出任何信息
 */
class Null extends AbstractAppender
{
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Log\Appender\AbstractAppender::append()
     */
    public function append($logEvent)
    {
        return;
    }
}
