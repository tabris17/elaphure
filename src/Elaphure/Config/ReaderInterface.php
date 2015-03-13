<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure\Config;

/**
 * 配置阅读器接口
 */
interface ReaderInterface
{
    /**
     * 载入配置文件
     * 
     * @param string $filename 配置文件名。
     * @return array 返回配置信息。
     */
    public function loadFromFile($filename);

    /**
     * 载入配置文件格式的字符串
     * 
     * @param string $string 配置信息字符串。
     * @return array 返回配置信息。
     */
    public function loadFromString($string);
}
