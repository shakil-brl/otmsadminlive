<?php
namespace App\Trait;

trait FileUpload
{
    public function upload($file, $file_name)
    {
        $file->move(public_path('img\\uploads'), $file_name);
        return true;
    }
}