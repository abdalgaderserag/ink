<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    public function Upload(Request $request)
    {
        list($type, $data) = explode(';', $request->file);
        list($code, $data) = explode(',', $data);
        list($file_type, $type) = explode(':', $type);
        list($file_type, $type) = explode('/', $type);
        if ($file_type == "image") {

            if ($code = "base64")
                $file_data = base64_decode($data);
            else
                return response()->json('error while decoding', 800);
            $this->image($data,$type);


        } else if ($file_type == "video") {

            if ($code = "base64")
                $file_data = base64_decode($data);
            else
                return response()->json('error while decoding', 800);
            $this->video($data,$type);


        } else {
            return response()->json('unknown file type', 800);
        }

        return response()->json($request, 200);
    }

    private function image($data,$type)
    {

    }

    private function video($data,$type)
    {

    }
}
