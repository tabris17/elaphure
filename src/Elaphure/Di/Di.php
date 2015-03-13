<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure\Di;

use Elaphure\Elaphure;

/**
 * 依赖注入类
 */
class Di implements DiInterface
{
    /**
     * 
     * @var array
     */
    protected $services = [];
    
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Di\DiInterface::register()
     */
    public function register($name, $definition, $shared = false)
    {
        $service = new Service();
        $service->setName($name);
        
        if ($definition instanceof \Closure) {
            $service->setShared($shared);
            $service->setDefinition($definition);
        } elseif (is_object($definition)) {
            $service->setShared(true);
            $service->setSharedInstance($definition);
        } else {
            throw new Exception\InvalidArgumentException(
                sprintf(
                    Elaphure::_('Definition should be closure or object; received "%s"'),
                    gettype($definition)
                )
            );
        }
        $this->services[$name] = $service;
        return $service;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Di\DiInterface::getService()
     */
    public function getService($name)
    {
        if (empty($this->services[$name])) {
            $service = $this->lazyRegister($name);
            if (false === $service) {
                return false;
            }
        } else {
            $service = $this->services[$name];
        }
        return $service;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Di\DiInterface::getServices()
     */
    public function getServices()
    {
        return $this->services;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Di\DiInterface::has()
     */
    public function has($name)
    {
        return isset($this->services[$name]);
    }
    
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Di\DiInterface::remove()
     */
    public function remove($name)
    {
        unset($this->services[$name]);
    }
    
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Di\DiInterface::get()
     */
    public function get($name)
    {
        $service = $this->getService($name);
        if (false === $service) {
            return false;
        }
        return $service->getInstance($this);
    }
    
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Di\DiInterface::getSharedInstance()
     */
    public function getSharedInstance($name)
    {
        $service = $this->getService($name);
        if (false === $service) {
            return false;
        }
        return $service->getSharedInstance($this);
    }
    
    /**
     * (non-PHPdoc)
     * @see \ArrayAccess::offsetExists()
     */
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }
    
    /**
     * (non-PHPdoc)
     * @see \ArrayAccess::offsetGet()
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }
    
    /**
     * (non-PHPdoc)
     * @see \ArrayAccess::offsetSet()
     */
    public function offsetSet($offset, $value)
    {
        $this->register($offset, $value);
    }
    
    /**
     * (non-PHPdoc)
     * @see \ArrayAccess::offsetUnset()
     */
    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }
}
