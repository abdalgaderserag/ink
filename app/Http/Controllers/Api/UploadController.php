<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\MediaRequest;
use App\Http\Controllers\Controller;
use App\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function Upload(MediaRequest $request)
    {
        list($type, $data) = explode(';', $request->file);
        list($code, $data) = explode(',', $data);
        list($file_type, $type) = explode(':', $type);
        list($file_type, $type) = explode('/', $type);

        if ($file_type == "image" || $file_type == "video") {
            if ($code == "base64") {
                $data = base64_decode($data);
            }
            $path = $file_type . '/' . Auth::user()->slug . '/' . decoct(random_int(1000, 20000)) . '.' . $type;

            Storage::disk('local')->put($path, $data);
        } else
            return response()->json('unknown file type', 800);

        return response()->json(['path' => $path, 'type' => $file_type], 200);
    }
}
