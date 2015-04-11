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
 * 禁止访问
 * 
 * 该异常能被框架捕获并返回 HTTP 403 错误页面。
 */
class Forbidden extends \RuntimeException implements Exception
{ }
