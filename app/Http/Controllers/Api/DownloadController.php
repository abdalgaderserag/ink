<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  $path
     * @return \Illuminate\Http\Response
     */
    public function __invoke($path)
    {
        $data = Storage::disk('local')->get("app/image/dr-julius-williamson/32236.jpeg");
        return response()->json($data, 200);
    }
}
