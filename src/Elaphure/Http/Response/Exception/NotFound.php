<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure\Http\Response\Exception;

use Elaphure\Http\Response\Exception;

/**
 * 无法找到页面
 * 
 * 该异常能被框架捕获并返回 HTTP 404 错误页面。
 */
class NotFound extends \RuntimeException implements Exception
{ }
