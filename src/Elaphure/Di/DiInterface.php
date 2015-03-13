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
 * 依赖注入组件
 */
interface DiInterface extends \ArrayAccess
{
    /**
     * 注册一个服务
     * 
     * @param string $name
     * @param mixed $definition
     * @param bool $shared
     * @return \Elaphure\Di\ServiceInterface
     */
    public function register($name, $definition, $shared = false);
    
    /**
     * 获取已注册服务
     * 
     * @param string $name
     * @return \Elaphure\Di\ServiceInterface|bool
     */
    public function getService($name);
    
    /**
     * 获取包含所有服务的数组
     * 
     * @return array
     */
    public function getServices();
    
    /**
     * 获取服务的实例
     * 
     * @param string $name
     * @return object|bool
     */
    public function get($name);
    
    /**
     * 获取服务的共享实例
     * 
     * @param string $name
     * @return object|bool
     */
    public function getSharedInstance($name);
    
    /**
     * 是否存在服务
     * 
     * @param string $name
     * @return bool
     */
    public function has($name);
    
    /**
     * 移除已注册服务
     * 
     * @param string $name
     * @return void
     */
    public function remove($name);
}
