<?php
/**
 * Elaphurus Framework
 *
 * @link      https://github.com/tabris17/elaphurus
 * @license   Public Domain (http://en.wikipedia.org/wiki/Public_domain)
 */

namespace Elaphure\Log\Appender;

use Elaphure\Log\Exception\RuntimeException;
use Elaphure\Log\layout\LayoutAwareTrait;
use Elaphure\Log\Layout\LayoutAwareInterface;
use Elaphure\Elaphure;

/**
 * PHP 流日志输出器
 */
class Stream extends AbstractAppender implements LayoutAwareInterface
{
    use LayoutAwareTrait;

    protected $filename;
    protected $mode;
    protected $useIncludePath;
    protected $contextOptions;
    protected $contextParams;
    
    private $handle;
    
    public function __construct($filename, $mode = 'a', $useIncludePath = false, $contextOptions = null, $contextParams = null)
    {
        $this->filename = $filename;
        $this->mode = $mode;
        $this->useIncludePath = $useIncludePath;
        $this->contextOptions = $contextOptions;
        $this->contextParams = $contextParams;
    }
    
    public function start()
    {
        if (!$this->isStarted) {
            if (isset($this->contextOptions)) {
                if (isset($this->contextParams)) {
                    $context = stream_context_create($this->contextOptions, $this->contextParams);
                } else {
                    $context = stream_context_create($this->contextOptions);
                }
                $handle = fopen($this->filename, $this->mode, $this->useIncludePath, $context);
            } else {
                $handle = fopen($this->filename, $this->mode, $this->useIncludePath);
            }
            if ($handle === false) {
                throw new RuntimeException(Elaphure::_('Fail to open stream'));
            }
            $this->handle = $handle;
            $this->isStarted = true;
        }
    }
    
    public function stop()
    {
        if ($this->isStarted) {
            fclose($this->handle);
            $this->handle = null;
            $this->isStarted = false;
        }
    }
    
    public function append($logEvent)
    {
        $handle = $this->handle;
        if (!fwrite($handle, $this->getLayout()->handle($logEvent) . PHP_EOL)) {
            throw new RuntimeException(Elaphure::_('Fail to write stream'));
        }
    }
}
