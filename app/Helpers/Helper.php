<?php

namespace App\Helpers;
use Illuminate\Support\Str;

class Helper {

    const COUNT_PER_PAGE = 10;

    // Static functions
    public static function saveFile($file, $folder_name = '') {
        if(isset($file) && is_file($file)) {
            $fileName  = now()->format('Ymd-His-u-') . Str::random(3);
            $fileName  = $fileName .'.'. $file->getClientOriginalExtension();
            if($folder_name) {
                $destinationPath = storage_path('files/'. $folder_name .'/');
            } else {
                $destinationPath = storage_path('files/');
            }
            $file->move($destinationPath, $fileName);
            return $fileName;
        }

        return null;
    }

    public static function deleteFileIfExists($relativePath)
    {
        $filePath = storage_path($relativePath);

        if (file_exists($filePath) && is_file($filePath)) {
            return unlink($filePath);
        }

        return false;
    }
    
}