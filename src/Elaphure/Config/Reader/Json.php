<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure\Config\Reader;

use Elaphure\Util\Json;
use Elaphure\Config\Exception\RuntimeException;
use Elaphure\Config\ReaderInterface;
use Elaphure\Elaphure;

/**
 * 读取 JSON 配置文件
 * 
 * 支持 "@include" 指令来引用外部文件。
 */
class Json implements ReaderInterface
{
    /**
     * 文件当前路径
     * 
     * @var string
     */
    protected $directory;

    /**
     * (non-PHPdoc)
     * @see \Elaphure\Config\ReaderInterface::loadFromFile()
     * @throws RuntimeException
     */
    public function loadFromFile($filename) 
    {
        if (!is_file($filename) || !is_readable($filename)) {
            throw new RuntimeException(
                sprintf(Elaphure::_('File "%s" doesn\'t exist or not readable'), $filename)
            );
        }
        
        $this->directory = dirname($filename);
        
        $config = json_decode(file_get_contents($filename), true);
        if ($config === null) {
            throw new RuntimeException(
                sprintf(Elaphure::_('Error reading JSON file "%s": %s'), $filename, Json::getLastError())
            );
        }
        
        return $this->process($config);
    }

    /**
     * (non-PHPdoc)
     * @see \Elaphure\Config\ReaderInterface::loadFromString()
     * @throws RuntimeException
     */
    public function loadFromString($string) 
    {
        if (empty($string)) {
            return [];
        }
        
        $this->directory = null;

        $config = json_decode($string, true);
        if ($config === null) {
            throw new RuntimeException(
                sprintf(Elaphure::_('Error reading JSON string: %s'), Json::getLastError())
            );
        }
        
        return $this->process($config);
    }

    /**
     * 处理原始数据
     * 
     * @param array $config 原始数据。
     * @return array 返回处理后的数据。
     */
    protected function process(&$config) 
    {
        foreach ($config as $k => &$v) {
            if (is_array($v)) {
                $this->process($v);
            } elseif ($k === '@include') {
                $reader = clone $this;
                if (empty($this->directory)) {
                    $includeFile = $v;
                } else {
                    $includeFile = $this->directory.DIRECTORY_SEPARATOR.$v;
                }
                $included = $reader->loadFromFile($includeFile);
                $config = array_replace_recursive((array)$config, $included);
                unset($config[$k]);
            }
        }
        return $config;
    }
}
