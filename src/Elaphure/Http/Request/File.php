<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure\Http\Request;

use Elaphure\Elaphure;

/**
 * 上传文件类
 */
class File
{
    private $key;
    private $name;
    private $type;
    private $tempName;
    private $size;
    private $error;

    /**
     * 
     * @param string $key 上传文件的参数名称。
     * @param string $name 上传文件的文件名。
     * @param string $type 上传文件的 MIME 类型。
     * @param string $tempName 上传文件的临时文件路径。
     * @param int $size 上传文件的大小。
     * @param int $error 上传错误代码。
     */
    public function __construct($key, $name, $type, $tempName, $size, $error)
    {
        $this->key = $key;
        $this->name = $name;
        $this->type = $type;
        $this->tempName = $tempName;
        $this->size = $size;
        $this->error = $error;
    }
    
    /**
     * 获取上传文件的参数名称
     * 
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }
    
    /**
     * 获取上传文件的文件名
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * 获取文件 MIME 类型
     * 
     * 文件类型是客户端提供的，不可信的。
     * @return string 返回文件 MIME 类型。
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * 获取上传文件的临时文件路径
     * 
     * @return string
     */
    public function getTempName()
    {
        return $this->tempName;
    }
    
    /**
     * 获取文件大小
     * 
     * @return int 返回文件大小。以字节为单位。
     */
    public function getSize()
    {
        return $this->size;
    }
    
    /**
     * 移动上传临时文件
     * 
     * @param string $path 移动目标路径。
     * @return bool 返回执行是否成功。
     */
    public function moveTo($path)
    {
        return move_uploaded_file($this->tempName, $path);
    }
    
    /**
     * 获取错误代码
     * 
     * @return int 返回错误代码。如果没有错误则返回 0。
     */
    public function getError()
    {
        return $this->error;
    }
}
