<?php
namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

trait Images
{
    public function uploadAvatarImage(UploadedFile $image, $folder = 'users')
    {

        $filename  = Str::random() . time() . '.' . $image->getClientOriginalExtension();

        $path = $filename;

        if (!file_exists(dirname(public_path($path)))) {
            mkdir(dirname(public_path($path)), 0755, true);
        }
        if (!file_exists(public_path('images/' . $folder))) {
            mkdir(public_path('images/' . $folder), 0755, true);
        }

        Image::read($image->getRealPath())->save(public_path('images/'.$folder.'/').$path);
        return $path;
    }



    public function uploadImage(UploadedFile $image, $path, $sizes = ['350x200', '500x300'])
    {
        $path .= $path[-1] == '/' ? '' : '/';

        $imagePrefix = Str::random() . time();

        $filename  = $imagePrefix . '_original_.' . $image->getClientOriginalExtension();


        $image->storeAs(public_path('images/'.$path), $filename);

        return  $filename;

    }
    public function deleteOldImage(?string $imagePath, $folder = 'users')
    {
        if ($imagePath && Storage::disk('public')->exists('images/' . $folder . '/' . $imagePath)) {
            Storage::disk('public')->delete('images/' . $folder . '/' . $imagePath);
        }
    }
    public function uploadMultipleImages($files, $folder = 'users')
    {
        $uploadedImages = [];
        foreach ($files as $file) {
            $uploadedImages[] = $this->uploadAvatarImage($file, $folder);
        }
        return $uploadedImages;
    }

    public function deleteImages($images , $folder = 'users')
    {
        foreach ($images as $image) {
            if (file_exists(public_path('images/' . $folder . '/' . $image))) {
                unlink(public_path('images/' . $folder . '/' . $image));
            }
        }
    }

}
