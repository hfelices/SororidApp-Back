<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class InstructionController extends Controller
{
    public function showInstructions()
    {
        return view('instructions');
    }

    public function downloadFile($filename)
    {
        $file = Storage::disk('public')->get($filename);
        $headers = [
            'Content-Type' => 'application/octet-stream',
        ];

        return response()->download(storage_path("app/public/{$filename}"), $filename, $headers);
    }
}
