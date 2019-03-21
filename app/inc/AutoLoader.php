<?php
/**
 * Static Class Autoloader
 * -----------------------------------------------------------
 * 
 */
class Autoloader
{
    public static function getFiles ($autoload, $extendsFiles)
    {
        $result = $extendsFiles;

        foreach($autoload as $path) {

            $dirFiles = array_diff(scandir($path), array('..', '.'));
            $files = self::getFilePath($path, $dirFiles, $extendsFiles);

            if (!empty($files) ) {
                $result = array_merge($result, $files);
            }
        }

        return $result;
    }

    private static function getFilePath ($path, $files, $extendsFiles)
    {
        $result = [];
        foreach($files as $file) {
            if (!in_array($path.$file, $extendsFiles) && file_exists($path.$file)) {
                $result[] = $path.$file;
            }
        }

        return $result;
    }
}
