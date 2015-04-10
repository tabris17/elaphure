<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure;

use Elaphure\Di\Di;
use Elaphure\Config\Config;
use Elaphure\Exception\ConfigException;
use Elaphure\Di\Compiler;

/**
 * 框架内核类
 * 
 * 提供框架的核心函数以及框架使用的助手函数。
 */
class Elaphure
{
    /**
     * 版本号
     * 
     * @const string
     */
    const VERSION = '1.0.0';
    
    /**
     * 代码路径
     * 
     * @const string
     */
    const BASE_PATH = __DIR__;
    
    /**
     * 框架名称
     * 
     * @const string
     */
    const VENDOR_NAME = 'fournoas\elaphure';
    
    
    /**
     * 本地化字符串函数
     *
     * @param string $text
     * @return string
     */
    public static function _($text)
    {
        return \dgettext(VENDOR_NAME, $text);
    }
    
    /**
     * 注册框架类的自动加载
     *
     * @return bool 返回注册是否成功。
     */
    public static function registerAutoloader()
    {
        $prefix = __NAMESPACE__ . '\\';
        $length = strlen($length);
        return spl_autoload_register(
            function ($className) use ($prefix, $length) {
                if (substr($className, 0, $length) === $prefix) {
                    require __DIR__ . DIRECTORY_SEPARATOR . $className . '.php';
                }
            }
        );
    }
    
    /**
     * 获取默认配置信息
     * 
     * @return \Elaphure\Config\Config
     */
    public static function getDefaultConfig()
    {
        return new Config([
            'application' => [
                'debug' => true,
                'deployment' => 'development',
            ],
            'logger' => [
                'writer' => '',
            ],
            'session' => [
                'engine' => 'memcache',
            ],
        ]);
    }

    /**
     * 创建 Application 对象
     * 
     * 尝试从 $bootstrap 文件中恢复对象。如果恢复失败，重新根据配置信息创建各个对象。
     * @param string|array $config 配置文件名或包含配置信息的数组。
     * @param string $bootstrap 启动文件。
     * @return \Elaphure\Application 返回 Application 对象。
     */
    public static function app($config, $bootstrap)
    {
        $boot = function () use ($config) {
            $config = self::getDefaultConfig()->merge(
                is_array($config) ? new Config($config) : Config::load($config)
            );
            
            $appName = $config->get('application.name');
            if (empty($appName)) {
                throw new ConfigException(
                    self::_('Missing "%s" in configuration', 'application.name')
                );
            }
            $app = new Application($appName);

            $di = new Di();
            
            $diCompiler = new Compiler();
            $diPredefinitions = '[';
            foreach ($config->get('services') as $serviceName => $diConfig) {
                $diPredefinitions .= '[';
                $diPredefinitions .= $diCompiler->compile($diConfig);
                $diPredefinitions .= ",\'";
                $diPredefinitions .= isset($diConfig['shared']) && $diConfig['shared'] ? 'true' : 'false';
                $diPredefinitions .= "\'";
                $diPredefinitions .= '],';
            }
            $diPredefinitions .= ']';
            
            $di->setPredefinitions($predefinitions);
            
            $app->setDi($di);
            $di->register('application', $app, true);
            return $app;
        };
        
        $app = include $bootstrap;
        if ($app === false) {
            $app = $boot();
        }
    }
}
