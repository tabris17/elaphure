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
 * 依赖注入组件依赖接口
 */
interface DiAwareInterface
{
    /**
     * 为对象设置依赖注入组件
     * 
     * @param \Elaphure\Di\DiInterface $di
     * @return void
     */
    public function setDi(DiInterface $di);
    
    /**
     * 返回依赖注入组件
     * 
     * @return \Elaphure\Di\DiInterface
     */
    public function getDi();
}
