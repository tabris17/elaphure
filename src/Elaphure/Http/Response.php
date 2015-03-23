<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure\Http;

class Response
{
    /**
     * 服务器出错
     * 
     * @const int
     */
    const STATUS_SERVER_ERROR = 500;
    
    /**
     * 服务不可用
     * 
     * @const int
     */
    const STATUS_SERVICE_UNAVAILABLE = 5.3;

    /**
     * 页面未找到
     *
     * @const int
     */
    const STATUS_NOT_FOUND = 404;
    
    /**
     * 禁止访问
     * 
     * @const int
     */
    const STATUS_FORBIDDEN = 403;
    
    /**
     * 正常
     * 
     * @const int
     */
    const STATUS_OK = 200;
    
    /**
     * HTTP 状态码
     * 
     * @var array
     */
    public static $status = [
        100 => 'CONTINUE',
        101 => 'SWITCHING PROTOCOLS',
        102 => 'PROCESSING',
        200 => 'OK',
        201 => 'CREATED',
        202 => 'ACCEPTED',
        203 => 'NON-AUTHORITATIVE INFORMATION',
        204 => 'NO CONTENT',
        205 => 'RESET CONTENT',
        206 => 'PARTIAL CONTENT',
        207 => 'MULTI-STATUS',
        208 => 'ALREADY REPORTED',
        226 => 'IM USED',
        300 => 'MULTIPLE CHOICES',
        301 => 'MOVED PERMANENTLY',
        302 => 'FOUND',
        303 => 'SEE OTHER',
        304 => 'NOT MODIFIED',
        305 => 'USE PROXY',
        306 => 'RESERVED',
        307 => 'TEMPORARY REDIRECT',
        308 => 'PERMANENT REDIRECT',
        400 => 'BAD REQUEST',
        401 => 'UNAUTHORIZED',
        402 => 'PAYMENT REQUIRED',
        403 => 'FORBIDDEN',
        404 => 'NOT FOUND',
        405 => 'METHOD NOT ALLOWED',
        406 => 'NOT ACCEPTABLE',
        407 => 'PROXY AUTHENTICATION REQUIRED',
        408 => 'REQUEST TIMEOUT',
        409 => 'CONFLICT',
        410 => 'GONE',
        411 => 'LENGTH REQUIRED',
        412 => 'PRECONDITION FAILED',
        413 => 'REQUEST ENTITY TOO LARGE',
        414 => 'REQUEST-URI TOO LONG',
        415 => 'UNSUPPORTED MEDIA TYPE',
        416 => 'REQUESTED RANGE NOT SATISFIABLE',
        417 => 'EXPECTATION FAILED',
        418 => "I'M A TEAPOT",
        422 => 'UNPROCESSABLE ENTITY',
        423 => 'LOCKED',
        424 => 'FAILED DEPENDENCY',
        426 => 'UPGRADE REQUIRED',
        428 => 'PRECONDITION REQUIRED',
        429 => 'TOO MANY REQUESTS',
        431 => 'REQUEST HEADER FIELDS TOO LARGE',
        500 => 'INTERNAL SERVER ERROR',
        501 => 'NOT IMPLEMENTED',
        502 => 'BAD GATEWAY',
        503 => 'SERVICE UNAVAILABLE',
        504 => 'GATEWAY TIMEOUT',
        505 => 'HTTP VERSION NOT SUPPORTED',
        506 => 'VARIANT ALSO NEGOTIATES',
        507 => 'INSUFFICIENT STORAGE',
        508 => 'LOOP DETECTED',
        510 => 'NOT EXTENDED',
        511 => 'NETWORK AUTHENTICATION REQUIRED',
    ];

}
