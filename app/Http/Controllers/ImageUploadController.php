<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ImageUploadController extends Controller
{
    public function showUploadForm()
    {
        return view('upload-form');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|file',
        ]);

        $file = $request->file('image');
        $response = Http::attach(
            'query', file_get_contents($file), $file->getClientOriginalName()
        )->post('https://ai.lombokeats.com/api/predict-data');

        $apiResponse = $response->json();
        return view('upload-form', [
            'apiResponse' => $apiResponse
        ]);
    }
     
}
