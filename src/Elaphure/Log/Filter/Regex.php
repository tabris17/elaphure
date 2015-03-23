<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure\Log\Filter;

/**
 * 正则表达式过滤器
 *
 * 只有消息匹配正则表达式的事件才能通过过滤器。
 */
class Regex extends AbstractFilter
{
    private $regex;

    /**
     * Constructor
     *
     * @param int $level
     */
    public function __construct($regex)
    {
        $this->regex = $regex;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Log\Filter\AbstractFilter::filter()
     */
    public function filter($logEvent)
    {
        return (bool)preg_match($this->regex, $logEvent->message);
    }
}
