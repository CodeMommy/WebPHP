<?php

// +----------------------------------------------------------------------
// | @author    Candison November (www.kandisheng.com)
// | @location  Nanjing China
// +----------------------------------------------------------------------

namespace LuckyPHP;

class File
{
    public static function upload($formname, $path, $rename = null)
    {
        if ($_FILES[$formname]['name'] != '') {
            if ($_FILES[$formname]['error'] > 0) {
                return false;
            } else {
                $fileOld = pathinfo($_FILES[$formname]['name']);
                $fileOldExtension = $fileOld['extension'];
                if($rename){
                    $filenameNew = $rename.'.'.$fileOldExtension;
                }else{
                    $filenameNew = $_FILES[$formname]['name'];
                }
                $filenameNew = $path . $filenameNew;
                if (move_uploaded_file($_FILES[$formname]['tmp_name'], $filenameNew)) {
                    return $filenameNew;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }
}