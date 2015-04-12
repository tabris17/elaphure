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
 * 发送文件响应
 * 
 * 使用 X-Sendfile、X-Accel-Redirect 头部来发送文件。
 */
class XSendFileResponse extends Response
{
    private $file;
    private $contentType;
    private $attachmentName;
    
    /**
     * 
     * @param string $file 文件路径。
     * @param string $contentType 文件类型。
     * @param string $attachmentName 附件文件名。
     */
    public function __construct($file, $contentType, $attachmentName = null)
    {
        parent::__construct('');
        $this->file = $file;
        $this->contentType = $contentType;
        $this->attachmentName = isset($attachmentName) ? 
            $attachmentName : 
            pathinfo($attachmentName, PATHINFO_BASENAME);
        $headers = $this->headers;
        $headers->set('Content-Type', $this->contentType);
        $headers->set('Content-Disposition', "attachment; filename=\"$this->attachmentName\"");
        // For Nginx
        $headers->set('X-Accel-Redirect', $this->file);
        // For Apache mod_xsendfile and Lighttpd
        $headers->set('X-Sendfile', $this->file);
    }
    
    /**
     * 下载限速
     * 
     * 仅 Nginx 下有效。
     * @param int $bytes 下载速率。单位为字节。如果小于等于 0 则表示不限速。
     * @return \Elaphure\Http\Response\SendFileResponse 返回当前对象。
     */
    public function setSendFileLimitRate($bytes)
    {
        if ($bytes <= 0) {
            $bytes = 'off';
        }
        $this->headers->set('X-Accel-Limit-Rate', $bytes);
        return $this;
    }
    
    /**
     * 允许缓存下载文件
     * 
     * 仅 Nginx 下有效。
     * @param int $expire 缓存过期时间。单位为秒。
     * @return \Elaphure\Http\Response\SendFileResponse 返回当前对象。
     */
    public function enableSendFileCache($expire)
    {
        $this->headers->set('X-Accel-Buffering', 'yes');
        $this->headers->set('X-Accel-Expires', $expire);
        return $this;
    }
    
    /**
     * 禁止缓存下载文件
     * 
     * 仅 Nginx 下有效。
     * @return \Elaphure\Http\Response\SendFileResponse 返回当前对象。
     */
    public function disableSendFileCache()
    {
        $this->headers->set('X-Accel-Buffering', 'no');
        $this->headers->set('X-Accel-Expires', 'off');
        return $this;
    }
}
