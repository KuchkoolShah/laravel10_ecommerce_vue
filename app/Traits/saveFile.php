<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait SaveFile
{
    public function saveImage($image, $oldImage = null, $path = "")
    {
        // Check if the image is not empty and is an uploaded file
        if ($image && $image->isValid()) {
            // Generate a unique name for the image
            $image_name = time() . '.' . $image->extension();

            // Save the image in the public directory
            $image->move(public_path($path), $image_name);

            // If an old image exists, delete it from public directory
            if ($oldImage && file_exists(public_path($oldImage))) {
                unlink(public_path($oldImage));
            }

            // Return the path to the saved image
            return $path . $image_name;
        }

        // If the image is empty or not valid, return null
        return null;
    }
}
