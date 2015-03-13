<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure\Util;

/**
 * 有优先级的列表的节点
 */
class PriorityListNode
{
    /**
     * 
     * @var \Elaphure\Util\PriorityListNode
     */
    public $next;
    
    /**
     * 
     * @var int
     */
    public $priority;
    
    /**
     * 
     * @var mixed
     */
    public $data;
}
