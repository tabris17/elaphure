<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure\Util;

use Elaphure\Elaphure;

/**
 * 封装系统 json_encode / json_decode 函数
 */
class Json
{
    /**
     * 将双引号 '"' 转换成 "\u0022"
     * 
     * @const int
     */
    const JSON_HEX_QUOT = JSON_HEX_QUOT;
    
    /**
     * 将 "<" 和 ">" 转换成 "\u003C" 和 "\u003E"
     * 
     * @const int
     */
    const JSON_HEX_TAG = JSON_HEX_TAG;
    
    /**
     * 将 "&" 转换成 "\u0026"
     * 
     * @const int
     */
    const JSON_HEX_AMP = JSON_HEX_AMP;
    
    /**
     * 将单引号 "'" 转换成 "\u0027"
     * 
     * @const int
     */
    const JSON_HEX_APOS = JSON_HEX_APOS;
    
    /**
     * 将数字格式的字符串转换成数字
     * 
     * @const int
     */
    const JSON_NUMERIC_CHECK = JSON_NUMERIC_CHECK;
    
    /**
     * 将长整型用字符串表达
     * 
     * @const int
     */
    const JSON_BIGINT_AS_STRING = JSON_BIGINT_AS_STRING;
    
    /**
     * 返回 JSON 字符串用空格来格式化
     * 
     * @const int
     */
    const JSON_PRETTY_PRINT = JSON_PRETTY_PRINT;
    
    /**
     * 不转义斜杠 "/"
     * 
     * @const int
     */
    const JSON_UNESCAPED_SLASHES = JSON_UNESCAPED_SLASHES;
    
    /**
     * 返回对象而不是数组
     * 
     * @const int
     */
    const JSON_FORCE_OBJECT = JSON_FORCE_OBJECT;
    
    /**
     * 不转义多字节 Unicode 字符
     * 
     * @const int
     */
    const JSON_UNESCAPED_UNICODE = JSON_UNESCAPED_UNICODE;
    
    /**
     * 编码
     * 
     * @param string $value
     * @param int $options 编码选项。
     * @param int $depth 递归深度。默认 512。
     * @return string 返回 JSON 格式字符串。
     */
    public static function encode($value, $options = null, $depth = null)
    {
        return json_encode($value, $options, $depth);
    }
    
    /**
     * 解码
     * 
     * @param string $json JSON 格式字符串。
     * @param bool $assoc 如果是 true，则返回对象将会被转换成联合数组。
     * @param int $depth 递归深度。默认 512。
     * @param int $options 仅支持 JSON_BIGINT_AS_STRING。
     * @return mixed 返回 JSON 对象或数组。
     */
    public static function decode($json, $assoc = null, $depth = null, $options = null)
    {
        return json_decode($json, $assoc, $depth, $options);
    }
    
    /**
     * 获得错误信息
     * 
     * @return string
     */
    public static function getLastError()
    {
        switch (json_last_error()) {
            case JSON_ERROR_NONE: return '';
            case JSON_ERROR_DEPTH: return Elaphure::_('The maximum stack depth has been exceeded');
            case JSON_ERROR_STATE_MISMATCH: return Elaphure::_('Invalid or malformed JSON');
            case JSON_ERROR_CTRL_CHAR: return Elaphure::_('Control character error, possibly incorrectly encoded');
            case JSON_ERROR_SYNTAX: return Elaphure::_('Syntax error');
            case JSON_ERROR_UTF8: return Elaphure::_('Malformed UTF-8 characters, possibly incorrectly encoded');
        }
        return Elaphure::_('Unknown json decode error');
    }
}
