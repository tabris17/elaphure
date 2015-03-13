<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure\Di;

/**
 * 服务接口
 */
interface ServiceInterface
{
    /**
     * 
     * @return string
     */
    public function getName();
    
    /**
     * 
     * @param string $name
     */
    public function setName($name);
    
    /**
     * 
     * @param bool $shared
     * @return void
     */
    public function setShared($shared);
    
    /**
     * 
     * @return bool
     */
    public function isShared();
    
    /**
     * @return bool
     */
    public function hasSharedInstance();
    
    /**
     * 
     * @param object $instance
     */
    public function setSharedInstance($instance);
    
    /**
     *
     * @param \Elaphure\Di\DiInterface $di
     * @return object
     */
    public function getSharedInstance($di);
    
    /**
     * 
     * @param \Closure $definition
     */
    public function setDefinition($definition);
    
    /**
     * @return \Closure
     */
    public function getDefinition();
    
    /**
     * 
     * @param \Elaphure\Di\DiInterface $di
     * @return object
     */
    public function createInstance($di);
    
    /**
     * 
     * @param \Elaphure\Di\DiInterface $di
     * @return object
     */
    public function getInstance($di);
}
