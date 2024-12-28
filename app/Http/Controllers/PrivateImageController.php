<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PrivateImageController extends Controller
{
    public function __invoke(Request $request): StreamedResponse
    {
        if (! $request->has('filename')) {
            abort(404);
        }

        $filename = $request->input('filename');

        if (! Storage::disk('local')->exists($filename)) {
            abort(404);
        }

        // Get the file content
        $fileStream = Storage::disk('local')->get($filename);

        // Return the file response
        return response()->stream(function () use ($fileStream) {
            echo $fileStream;
        }, 200, [
            'Content-Type' => Storage::disk('local')->mimeType($filename),
        ]);
    }
}
