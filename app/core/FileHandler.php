<?php

class FileHandler
{
    public static function setUpload ()
    {
        $error = [];
        $file_name = '';

        if (isset($_FILES['image'])) {
            $timeStamp = date('Y-d-m-H-i-s');
            $file_name = $timeStamp.'-'.$_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];
            $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
            
            $extensions= ["jpeg","jpg","png"];
            
            if(in_array($file_ext,$extensions) === false){
               $error[] = "extension not allowed, please choose a JPEG or PNG file.";
            }
            
            if($file_size > 2097152) {
               $error[] = 'File size must be excately 2 MB';
            }
            
            if(empty($error) === true) {
               move_uploaded_file($file_tmp, IMAGE_PATH.$file_name);
            }
         }

         return ['fileName' => $file_name,'error' => $error];
    }
}