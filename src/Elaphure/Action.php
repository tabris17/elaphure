<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure;

use Elaphure\Http\Response;

/**
 * 动作类
 */
class Action
{

    /**
     *
     * @param \Elaphure\Http\Request $request
     * @return \Elaphure\Http\Response
     */
    public function __invoke($request)
    {
        return new Response();
    }
}
