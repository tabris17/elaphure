<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure;

use Elaphure\Di\DiAwareTrait;
use Elaphure\Di\DiAwareInterface;
use Elaphure\Event\EventAwareInterface;
use Elaphure\Event\EventAwareTrait;
use Elaphure\Log\LoggerAwareInterface;
use Elaphure\Log\LoggerAwareTrait;
use Elaphure\Config\Config;

/**
 * 应用类
 */
class Application implements 
    DiAwareInterface,
    EventAwareInterface,
    LoggerAwareInterface
{
    use DiAwareTrait, EventAwareTrait, LoggerAwareTrait;
    
    /**
     * 请求路由器
     * 
     * @var \Elaphure\Router
     */
    protected $router;

    /**
     * 
     */
    public function __construct()
    {

    }
    
    public function run()
    {
        
    }

}
