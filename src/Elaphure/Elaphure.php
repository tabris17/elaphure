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
use Elaphure\Config\Factory as ConfigFactory;

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
                ''
            ],
        ]);
    }

    public static function createApplication()
    {
        function () {
            $di = new Di();
            $config = new Config(ConfigFactory::read($filename));
            $app = new Application();
        };
    }
}
