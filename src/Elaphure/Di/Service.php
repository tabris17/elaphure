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
 * 依赖注入服务类
 */
class Service implements ServiceInterface
{
    private $shared;
    private $sharedInstance;
    private $name;
    private $definition;
    
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Di\ServiceInterface::getName()
     */
    public function getName()
    {
        return $thi->name;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Di\ServiceInterface::setName()
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Di\ServiceInterface::setShared()
     */
    public function setShared($shared)
    {
        $this->shared = $shared;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Di\ServiceInterface::isShared()
     */
    public function isShared()
    {
        return $this->shared;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Di\ServiceInterface::hasSharedInstance()
     */
    public function hasSharedInstance()
    {
        return isset($this->sharedInstance);
    }
    
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Di\ServiceInterface::getSharedInstance()
     */
    public function getSharedInstance($di)
    {
        if (empty($this->sharedInstance)) {
            $this->sharedInstance = $this->createInstance($di);
        }
        return $this->sharedInstance;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Di\ServiceInterface::setSharedInstance()
     */
    public function setSharedInstance($instance)
    {
        $this->sharedInstance = $instance;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Di\ServiceInterface::setDefinition()
     */
    public function setDefinition($definition)
    {
        $this->definition = $definition;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Di\ServiceInterface::getDefinition()
     */
    public function getDefinition()
    {
        return $this->definition;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Di\ServiceInterface::createInstance()
     */
    public function createInstance($di)
    {
        $closure = $this->definition;
        return $closure($di);
    }
    
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Di\ServiceInterface::getInstance()
     */
    public function getInstance($di)
    {   
        return $this->shared ? $this->getSharedInstance($di) : $this->createInstance($di);
    }
}
