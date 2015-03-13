<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure\Config\Writer;

use Elaphure\Config\Exception\RuntimeException;
use Elaphure\Config\WriterInterface;
use Elaphure\Elaphure;

/**
 * 配置文件书写器抽象类
 */
abstract class AbstractWriter implements WriterInterface
{
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Config\WriterInterface::save()
     */
    public function save($filename, array $config) 
    {
        if (empty($filename)) {
            throw new RuntimeException(Elaphure::_('No file name specified'));
        }
        set_error_handler(
            function ($error, $message = '', $file = '', $line = 0) use ($filename) {
                throw new RuntimeException(
                    sprintf(Elaphure::_('Error writing to "%s": %s'), $filename, $message),
                    $error
                );
            }, E_WARNING
        );
        try {
            file_put_contents($filename, $this->toString($config));
        } catch(RuntimeException $exception) {
            restore_error_handler();
            throw $exception;
        }
        restore_error_handler();
    }

    /**
     * (non-PHPdoc)
     * @see \Elaphure\Config\WriterInterface::toString()
     */
    abstract public function toString(array $config);
}
