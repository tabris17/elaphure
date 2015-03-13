<?php
/**
 * Elaphurus Framework
 *
 * @link      https://github.com/tabris17/elaphurus
 * @license   Public Domain (http://en.wikipedia.org/wiki/Public_domain)
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
