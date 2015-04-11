<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure\Http\Response;

use Elaphure\Http\Response;

/**
 * 响应 Json 数据
 */
class Json extends Response
{
    /**
     * 
     * @param mixed $data
     */
    public function __construct($data)
    {
        parent::__construct(json_encode($data));
    }
}
