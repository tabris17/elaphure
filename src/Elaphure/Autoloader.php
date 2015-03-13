<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure;

/**
 * PSR-4 规范的类装载器
 */
class Autoloader
{
    /**
     * 命名空间分隔符。
     * 
     * @const string
     */
    const NAMESPACE_SEPARATOR = '\\';
    
    /**
     * 保存命名空间前缀和对应源文件目录的键值对数组。
     * 
     * @var array
     */
    protected $prefixes = [];
    
    /**
     * 保存类名和对应文件名的键值对数组。
     *
     * @var array
     */
    protected $classes = [];
    
    /**
     * 注册自动加载到系统
     * 
     * @return bool
     */
    public function register()
    {
        return spl_autoload_register([$this, 'load']);
    }
    
    /**
     * 从系统注销自动加载
     *
     * @return bool
     */
    public function unregister()
    {
        return spl_autoload_unregister([$this, 'load']);
    }
    
    /**
     * 系统自动加载入口
     * 
     * @param string $className 类名。
     * @return void
     */
    public function load($className)
    {
        $prefix = $className;

        while (false !== $pos = strrpos($prefix, self::NAMESPACE_SEPARATOR)) {
            $prefix = substr($className, 0, $pos + 1);
            $partialClassName = substr($className, $pos + 1);

            if (empty($this->prefixes[$prefix])) continue;

            foreach ($this->prefixes[$prefix] as $path) {
                if (self::NAMESPACE_SEPARATOR !== DIRECTORY_SEPARATOR) {
                    $partialClassName = str_replace(
                        self::NAMESPACE_SEPARATOR,
                        DIRECTORY_SEPARATOR,
                        $partialClassName
                    );
                }
                $file = $path. $partialClassName . '.php';
                if (file_exists($file)) {
                    require $file;
                }
            }
            $prefix = rtrim($prefix, self::NAMESPACE_SEPARATOR);
        }
        
        if (isset($this->classes[$className])) {
            $file = $this->classes[$className];
            if (file_exists($file)) {
                require $file;
            }
        }
    }

    /**
     * 添加类源文件
     * 
     * @param string $className 包含命名空间路径的完整类名。
     * @param string $filename 包含文件完整路径的源文件名。
     * @return \Elaphure\Autoloader 返回当前对象。
     */
    public function addClass($className, $filename)
    {
        $this->classes[$className] = $filename;
        return $this;
    }

    /**
     * 添加多个类源文件
     * 
     * @param array $classFilePairs 类源文件的键值对数组。
     * @return \Elaphure\Autoloader 返回当前对象。
     */
    public function addClasses(array $classFilePairs)
    {
        foreach ($classFilePairs as $className => $filename) {
            $this->addClass($className, $filename);
        }
        return $this;
    }

    /**
     * 添加命名空间前缀对应的源代码路径
     * 
     * @param string $prefix 命名空间前缀。
     * @param string $path 源代码路径。
     * @param bool $prepend 如果是 true，则将路径添加到该命名空间前缀的路径列表首部，否则追加到尾部。
     * @return \Elaphure\Autoloader 返回当前对象。
     */
    public function addNamespace($prefix, $path, $prepend = false)
    {
        $prefix = trim($prefix, self::NAMESPACE_SEPARATOR) 
                . self::NAMESPACE_SEPARATOR;
        $path = rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        
        if (isset($this->prefixes[$prefix]) === false) {
            $this->prefixes[$prefix] = [];
        }
        
        if ($prepend) {
            array_unshift($this->prefixes[$prefix], $path);
        } else {
            array_push($this->prefixes[$prefix], $path);
        }

        return $this;
    }

    /**
     * 添加多个命名空间前缀对应的源代码路径
     * 
     * @param array $prefixPathPairs 命名空间前缀和源代码路径的键值对数组。
     * @param bool $prepend 如果是 true，则将路径添加到该命名空间前缀的路径列表首部，否则追加到尾部。
     * @return \Elaphure\Autoloader 返回当前对象。
     */
    public function addNamespaces(array $prefixPathPairs, $prepend = false)
    {
        foreach ($prefixPathPairs as $prefix => $path) {
            $this->addNamespace($prefix, $path, $prepend);
        }
        return $this;
    }
}
