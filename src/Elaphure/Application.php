<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure;

use Elaphure\Di\DiAwareTrait;
use Elaphure\Di\DiAwareInterface;
use Elaphure\Event\EventAwareInterface;
use Elaphure\Event\EventAwareTrait;
use Elaphure\Log\LoggerAwareInterface;
use Elaphure\Log\LoggerAwareTrait;
use Elaphure\Config\Config;
use Elaphure\Http\Response;

/**
 * 应用类
 */
class Application implements 
    DiAwareInterface,
    EventAwareInterface,
    LoggerAwareInterface
{
    use DiAwareTrait, EventAwareTrait, LoggerAwareTrait;
    
    /**
     * 错误事件
     * 
     * @const string
     */
    const EVENT_ERROR = 'error';
    
    /**
     * 未捕获异常事件
     *
     * @const string
     */
    const EVENT_EXCEPTION = 'exception';
    
    /**
     * 系统关闭事件
     *
     * @const string
     */
    const EVENT_SHUTDOWN = 'shutdown';
    
    /**
     * 请求前事件
     *
     * @const string
     */
    const EVENT_BEFORE_REQUEST = 'before request';
    
    /**
     * 请求后事件
     *
     * @const string
     */
    const EVENT_AFTER_REQUEST = 'after request';
    
    
    /**
     * 请求路由器
     * 
     * @var \Elaphure\Router
     */
    protected $router;
    
    /**
     * 请求对象
     * 
     * @var \Elaphure\Http\Request
     */
    protected $request;
    
    /**
     * 响应对象
     * 
     * @var \Elaphure\Http\Response
     */
    protected $response;
    
    /**
     * 名称
     * 
     * @var string
     */
    protected $name;
    
    /**
     * 开启调试
     * 
     * 默认开启。
     * @var bool
     */
    protected $debug = true;
    
    /**
     * 部署模式
     * 
     * 默认为开发模式。
     * @var string
     */
    protected $deployment = 'development';
    
    /**
     * 
     * @param string $name 名称。
     */
    public function __construct($name)
    {
        $this->name = $name;
    }
    
    /**
     * 获取响应对象
     * 
     * @return \Elaphure\Http\Response
     */
    public function getResponse()
    {
        return $this->response;
    }
    
    /**
     * 获取请求对象
     * 
     * @return \Elaphure\Http\Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * 获取路由器
     * 
     * @return \Elaphure\Router
     */
    public function getRouter()
    {
        return $this->router;
    }
    
    /**
     * 
     * @return void
     */
    public function run()
    {
        $result = $this->triggerEvent(self::EVENT_BEFORE_REQUEST, null, true);
        $this->triggerEvent(self::EVENT_AFTER_REQUEST);
    }
    
    /**
     * 设置错误处理函数
     * 
     * @return void
     */
    public function handleError($types = null)
    {
        $self = $this;
        set_error_handler(
            function ($type, $message, $file, $line, $context) use ($self) {
                $result = $self->triggerEvent(self::EVENT_ERROR, [
                    'type' => $type,
                    'message' => $message,
                    'file' => $file,
                    'line' => $line,
                    'context' => $context
                ], true);
                if ($result && $result->isDefaultPrevented()) {
                    return false;
                }
                $this->response->status(Response::STATUS_SERVER_ERROR);
                $this->response->write(
                    $this->outputErrorHtml($type, $message, $file, $line, $context)
                );
                $this->response->end();
            },
            empty($types) ? E_ALL | E_STRICT : $types
        );
    }

    
    /**
     * 设置异常处理函数
     * 
     * @return void
     */
    public function handleException()
    {
        $self = $this;
        set_exception_handler(function ($exception) use ($self) {
            $result = $self->triggerEvent(self::EVENT_EXCEPTION, $exception, true);
            if ($result && $result->isDefaultPrevented()) {
                return;
            }
            $this->response->status(Response::STATUS_SERVER_ERROR);
            $this->response->write($this->outputExceptionHtml($exception));
            $this->response->end();
        });
    }

    /**
     * 处理系统关闭
     * 
     * @return void
     */
    public function handleShutdown()
    {
        $self = $this;
        register_shutdown_function(function () use ($self) {
            if ($error = error_get_last()) {
                extract($error);
                $result = $self->triggerEvent(self::EVENT_ERROR, [
                    'type' => $type,
                    'message' => $message,
                    'file' => $file,
                    'line' => $line,
                    'context' => []
                ], true);
                if ($result && $result->isDefaultPrevented()) {
                    return;
                }
                $this->response->status(Response::STATUS_SERVER_ERROR);
                $this->response->write($this->outputErrorHtml($type, $message, $file, $line, []));
                $this->response->end();
            }
            $self->triggerEvent(self::EVENT_SHUTDOWN);
        });
    }
    
    /**
     * 输出错误页面
     * 
     * @param int $type
     * @param string $message
     * @param string $file
     * @param int $line
     * @param array $context
     * @return string
     */
    protected function outputErrorHtml($type, $message, $file, $line, $context)
    {
        return '<h1>Server Error</h1>';
    }
    
    /**
     * 输出异常页面
     * 
     * @param \Exception $exception
     * @return string
     */
    protected function outputExceptionHtml($exception)
    {
        return '<h1>Server Error</h1>';
    }
}
