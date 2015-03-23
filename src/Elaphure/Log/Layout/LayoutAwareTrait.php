<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure\Log\layout;

use Elaphure\Log\Layout\Line;

/**
 * 实现日志布局依赖接口
 */
trait LayoutAwareTrait
{
    /**
     * @var LayoutInterface
     */
    protected $layout = null;
    
    /**
     * 
     * @param \Elaphure\Log\Layout\LayoutInterface $layout
     * @return void
     */
    public function setLayout(LayoutInterface $layout)
    {
        $this->layout = $layout;
    }
    
    /**
     * 
     * @return \Elaphure\Log\Layout\LayoutInterface
     */
    public function getLayout()
    {
        if (empty($this->layout)) {
            $this->layout = new Line();
        }
        return $this->layout;
    }
}
