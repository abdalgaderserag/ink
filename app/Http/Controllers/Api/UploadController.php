<?php

namespace App\Http\Controllers\Api;

use App\Jobs\DecodeFiles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function Upload(Request $request)
    {
        list($type, $data) = explode(';', $request->file);
        list($code, $data) = explode(',', $data);
        list($file_type, $type) = explode(':', $type);
        list($file_type, $type) = explode('/', $type);

        if ($file_type == "image" || $file_type == "video") {
            $path = '/temp/'.$file_type . '/' . $request->type . '/' . Auth::id() . '/' . decoct(random_int(1000, 20000)) . '/' . $type;
            Storage::disk('local')->put($path, $data);
            DecodeFiles::dispatch($path,$code);
        } else
            return response()->json('unknown file type', 800);

        return response()->json($request, 200);
    }

    private function image($data, $type)
    {

    }

    private function video($data, $type)
    {

    }
}
