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
 * 配置书写器接口
 */
interface WriterInterface
{
    /**
     * 保存配置文件
     * 
     * @param string $filename 配置文件名。
     * @param array $config 配置信息数组。
     * @return void
     */
    public function save($filename, array $config);

    /**
     * 获得配置文件格式字符串
     * 
     * @param array $config 配置信息数组。
     * @return string 返回配置文件格式的字符串。
     */
    public function toString(array $config);
}
