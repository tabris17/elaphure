<?php
/**
 * Elaphure PHP Framework
 *
 * @link      https://github.com/fournoas/elaphure
 * @author    tabris17 <elaphure@fournoas.com>
 * @version   1.0.0
 */
namespace Elaphure\Http\Exception;

use Elaphure\Http\Exception;

/**
 * 文件上传错误异常
 */
class UploadError extends \RuntimeException implements Exception
{
    /**
     * 
     * @param int $error 错误代码。
     */
    public function __construct($error) {
        parent::__construct(self::getErrorMessage($error), $error);
    }
    
    /**
     * 根据错误代码获取错误信息
     * 
     * @param int $error 错误代码。
     * @return string 返回错误信息。
     */
    public static function getErrorMessage($error)
    {
        switch ($error) {
            case UPLOAD_ERR_CANT_WRITE: return Elaphure::_('Failed to write file to disk');
            case UPLOAD_ERR_EXTENSION: return Elaphure::_('File upload stopped by extension');
            case UPLOAD_ERR_FORM_SIZE: return Elaphure::_('The uploaded file exceeds the "MAX_FILE_SIZE" directive that was specified in the HTML form');
            case UPLOAD_ERR_INI_SIZE: return Elaphure::_('The uploaded file exceeds the "upload_max_filesize" directive in php.ini');
            case UPLOAD_ERR_NO_FILE: return Elaphure::_('No file was uploaded');
            case UPLOAD_ERR_NO_TMP_DIR: return Elaphure::_('Missing a temporary folder');
            case UPLOAD_ERR_PARTIAL: return Elaphure::_('The uploaded file was only partially uploaded');
            case UPLOAD_ERR_OK: return '';
        };
        return Elaphure::_('Unknown upload error');
    }
}
