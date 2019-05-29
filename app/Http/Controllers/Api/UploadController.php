<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    public function image(Request $request)
    {
        return response($request);
    }

    public function video()
    {
        
    }
}
