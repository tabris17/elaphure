<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure\Log\Appender;

/**
 * 按日写入文件
 */
class DailyFile extends Stream
{

    /**
     * Constructor
     * 
     * @param string $path
     */
    public function __construct($path)
    {
        $filename = $path . DIRECTORY_SEPARATOR . date('Y-m-d') . '.log';
        parent::__construct($filename);
    }
}
