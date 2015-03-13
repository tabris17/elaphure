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
use Elaphure\Elaphure;
use Elaphure\Util\Json;

/**
 * JSON 格式配置书写器类
 */
class Json extends AbstractWriter
{
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Config\Writer\AbstractWriter::toString()
     * @throws RuntimeException
     */
    public function toString(array $config) 
    {
        $json = json_encode($config);
        if ($json === false) {
            throw new RuntimeException(
                sprintf(Elaphure::_('Error encoding JSON string: %s'), Json::getLastError())
            );
        }
        return $json;
    }
}
