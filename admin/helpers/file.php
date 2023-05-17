<?php

require 'helpers/string.php';

if (!function_exists('saveAndResizeImage')) {
  function saveAndResizeImage($image, int $width, int $height) {
    $tmpPath = $image['tmp_name'];
    $imageExt = pathinfo($image['name'], PATHINFO_EXTENSION);
          
    if ($imageExt == 'jpg' || $imageExt == 'jpeg') {
      $image = imagecreatefromjpeg($tmpPath);
    }
  
    if ($imageExt == 'png') {
      $image = imagecreatefrompng($tmpPath);
    }
  
    $imgResized = imagescale($image , $width, $height);
    $filename = generateRandomString().'.'.$imageExt;
  
    if ($imageExt == 'jpg' || $imageExt == 'jpeg') {
      imagejpeg($imgResized, 'photos/'.$filename);
    }
  
    if ($imageExt == 'png') {
      imagepng($imgResized, 'photos/'.$filename);
    }
  
    return $filename;
  }
}