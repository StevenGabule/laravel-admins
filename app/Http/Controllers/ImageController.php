<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductUploadImageReq;
use Str, Storage;

class ImageController extends Controller
{
    public function upload(ProductUploadImageReq $request)
    {
        $file = $request->file('image');
        $name = Str::random(10);
        $url = Storage::putFileAs('images', $file, $name . '.' . $file->extension());
        return "http://localhost:8000/{$url}";
    }
}
