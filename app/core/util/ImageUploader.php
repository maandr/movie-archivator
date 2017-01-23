<?php
class ImageUploader
{
    protected static $uploadDirectory = MEDIA_PATH;
    protected static $maxFileSizeKb = MAX_UPLOAD_SIZE;
    protected static $allowedExtensions = array( "jpg", "jpeg", "png", "gif");
    
    public static function uploadImage($target)
    {
        $targetFile = self::$uploadDirectory.basename($target['name']);
        
        if(self::IsImage($target['tmp_name']) && self::IsValidExtension($targetFile) && self::IsValidSize($target) && self::DoesNotExist($targetFile))
        {
            if(!move_uploaded_file($target['tmp_name'], $targetFile))
            {
                throw new Exception("An error occured during the uploading process.");
            }
            else
            {
                return true;
            }
        }
        
        return false;
    }
    
    private static function IsImage($file)
    {
        if(!getimagesize($file))
            throw new Exception("The file to load isn't a image type.");
        
        return true;
    }
    
    private static function IsValidExtension($file)
    {
        if(!in_array(pathinfo($file, PATHINFO_EXTENSION), self::$allowedExtensions))
            throw new Exception("The file extension of the target file is not allowed.");

        return true;
    }
    
    private static function IsValidSize($file)
    {
        if($file['size'] > self::$maxFileSizeKb)
            throw new Exception("The filesize is to large.");
        
        return true;
    }
    
    private static function DoesNotExist($file)
    {
        if(file_exists($file))
            throw new Exception("A file named $file already exists.");
        
        return true;
    }
}
?>
