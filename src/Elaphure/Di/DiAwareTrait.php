<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure\Di;

/**
 * 
 */
trait DiAwareTrait
{
    /**
     * 
     * @var \Elaphure\Di\DiInterface
     */
    protected $di = null;
    
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Di\DiAwareInterface::setDi()
     */
    public function setDi(DiInterface $di)
    {
        $this->di = $di;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Elaphure\Di\DiAwareInterface::getDi()
     */
    public function getDi()
    {
        return $this->di;
    }
}
