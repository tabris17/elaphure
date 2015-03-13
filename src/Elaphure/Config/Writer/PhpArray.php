<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure\Config\Writer;

/**
 * PHP 数组配置书写器类
 */
class PhpArray extends AbstractWriter
{
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Config\Writer\AbstractWriter::toString()
     */
    protected function toString($config)
    {
        return '<?php return '.var_export($config, true).';';
    }
}
