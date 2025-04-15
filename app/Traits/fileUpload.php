<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait FileUpload
{

    function uploadFile(UploadedFile $file, string $directory = 'uploads'): string
    {
        // Generate a unique filename
        $filename = 'lc_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // check if directory exists, if not create it
        if (!is_dir(public_path($directory))) {
            mkdir(public_path($directory), 0755, true);
        }

        $file->move(public_path($directory), $filename);

        return '/' . $directory . '/' . $filename;
    }

}