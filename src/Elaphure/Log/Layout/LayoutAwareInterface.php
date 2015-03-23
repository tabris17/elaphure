<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure\Log\Layout;

/**
 * 日志布局依赖接口
 */
interface LayoutAwareInterface
{
    /**
     * 
     * @param \Elaphure\Log\Layout\LayoutInterface $layout
     * @return void
     */
    public function setLayout(LayoutInterface $layout);

    /**
     * @return \Elaphure\Log\Layout\LayoutInterface
     */
    public function getLayout();
}
