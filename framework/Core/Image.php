<?php

// +----------------------------------------------------------------------
// | @author    Candison November (www.kandisheng.com)
// | @location  Nanjing China
// +----------------------------------------------------------------------

namespace LuckyPHP;

class Image
{
    public static function compression($imageOldPath, $imageNewPrefix, $maxWidth, $maxHeight)
    {
        $fileInformation = pathinfo($imageOldPath);
        $filePath = $fileInformation['dirname'];
        $fileFullName = $fileInformation['basename'];
        $fileExtension = $fileInformation['extension'];
        $fileName = explode('.', $fileFullName);
        $fileName = $fileName[0];

        $imageNewName = $imageNewPrefix . $fileName . "." . $fileExtension;
        $imageNewPath = $filePath . "/" . $imageNewName;

        if ($fileExtension == 'jpg') {
            $imageOld = imageCreateFromJpeg($imageOldPath);
        } else if ($fileExtension == 'jpeg') {
            $imageOld = imageCreateFromJpeg($imageOldPath);
        } else if ($fileExtension == 'png') {
            $imageOld = imageCreateFromPng($imageOldPath);
        } else if ($fileExtension == 'gif') {
            $imageOld = imageCreateFromGif($imageOldPath);
        } else {
            $imageOld = imageCreateFromJpeg($imageOldPath);
        }
        $imageOldWidth = imagesx($imageOld);
        $imageOldHeight = imagesy($imageOld);

        if (($maxWidth && $imageOldWidth > $maxWidth) || ($maxHeight && $imageOldHeight > $maxHeight)) {
            $resizeWidthTtag = false;
            $resizeHeightTag = false;
            $ratioWidth = 1;
            $ratioHeight = 1;
            $ratio = 1;

            if ($maxWidth && $imageOldWidth > $maxWidth) {
                $ratioWidth = $maxWidth / $imageOldWidth;
                $resizeWidthTtag = true;
            }
            if ($maxHeight && $imageOldHeight > $maxHeight) {
                $ratioHeight = $maxHeight / $imageOldHeight;
                $resizeHeightTag = true;
            }
            if ($resizeWidthTtag && $resizeHeightTag) {
                if ($ratioWidth < $ratioHeight) {
                    $ratio = $ratioWidth;
                } else {
                    $ratio = $ratioHeight;
                }
            }
            if ($resizeWidthTtag && !$resizeHeightTag) {
                $ratio = $ratioWidth;
            }
            if ($resizeHeightTag && !$resizeWidthTtag) {
                $ratio = $ratioHeight;
            }
            $newwidth = $imageOldWidth * $ratio;
            $newheight = $imageOldHeight * $ratio;
            if (function_exists('imagecopyresampled')) {
                $imageNew = imagecreatetruecolor($newwidth, $newheight);
                imagecopyresampled($imageNew, $imageOld, 0, 0, 0, 0, $newwidth, $newheight, $imageOldWidth, $imageOldHeight);
            } else {
                $imageNew = imagecreate($newwidth, $newheight);
                imagecopyresized($imageNew, $imageOld, 0, 0, 0, 0, $newwidth, $newheight, $imageOldWidth, $imageOldHeight);
            }

            if ($fileExtension == 'jpg') {
                imagejpeg($imageNew, $imageNewPath);
            } else if ($fileExtension == 'jpeg') {
                imagejpeg($imageNew, $imageNewPath);
            } else if ($fileExtension == 'png') {
                imagepng($imageNew, $imageNewPath);
            } else if ($fileExtension == 'gif') {
                imagegif($imageNew, $imageNewPath);
            } else {
                imagejpeg($imageNew, $imageNewPath);
            }
            imagedestroy($imageNew);
        } else {
            if ($fileExtension == 'jpg') {
                imagejpeg($imageOld, $imageNewPath);
            } else if ($fileExtension == 'jpeg') {
                imagejpeg($imageOld, $imageNewPath);
            } else if ($fileExtension == 'png') {
                imagepng($imageOld, $imageNewPath);
            } else if ($fileExtension == 'gif') {
                imagegif($imageOld, $imageNewPath);
            } else {
                imagejpeg($imageOld, $imageNewPath);
            }
        }
        return $imageNewName;
    }
}