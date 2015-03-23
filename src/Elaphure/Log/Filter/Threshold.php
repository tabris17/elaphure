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
 * 日志记录等级的最低门槛
 */
class Threshold extends AbstractFilter
{
    private $level;
    
    /**
     * Constructor
     * 
     * @param int $level
     */
    public function __construct($level)
    {
        $this->level = $level;
    }

    /**
     * (non-PHPdoc)
     * @see \Elaphure\Log\Filter\AbstractFilter::filter()
     */
    public function filter($logEvent)
    {
        return $logEvent->level <= $this->level;
    }
}
