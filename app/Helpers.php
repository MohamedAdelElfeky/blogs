<?php


function save_image($photo, $folder)
{
    $file_extension = $photo->getClientOriginalExtension();
    $file_name = time() . 'image_for_web.' . $file_extension;
    $photo->move($folder, $file_name);
    return $file_name;
}
