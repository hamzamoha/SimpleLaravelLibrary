<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function getPhoto($url)
    {
        if (File::exists(storage_path('authors/photos/' . $url))) {

            $photo = File::get(storage_path('authors/photos/' . $url));
            $type = File::mimeType(storage_path('authors/photos/' . $url));

            return Response::make($photo, 200)->header("Content-Type", $type);
        } else
            return abort(404);
    }
    public function getCover($url)
    {
        if (File::exists(storage_path('books/cover/' . $url))) {
            $photo = File::get(storage_path('books/cover/' . $url));
            $type = File::mimeType(storage_path('books/cover/' . $url));
            return Response::make($photo, 200)->header("Content-Type", $type);
        } else
            return abort(404);
    }
    public function getPDF($url)
    {
        if (File::exists(storage_path('books/pdf/' . $url))) {
            $photo = File::get(storage_path('books/pdf/' . $url));
            $type = File::mimeType(storage_path('books/pdf/' . $url));
            return Response::make($photo, 200)->header("Content-Type", $type);
        } else
            return abort(404);
    }
}
