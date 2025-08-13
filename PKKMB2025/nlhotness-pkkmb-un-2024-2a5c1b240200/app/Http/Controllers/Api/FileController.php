<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function view(Request $request, $folder, $fileName)
    {
        // Membuat path file berdasarkan folder dan nama file
        $filePath = 'public/' . $folder . '/' . $fileName;
    
        // Cek apakah file ada di storage
        if (Storage::exists($filePath)) {
            // Dapatkan URL untuk mengakses file
            $fileUrl = Storage::url($filePath);
    
            return response()->json([
                "success" => true,
                "file_url" => $fileUrl,
            ], 200); // Status HTTP 200 OK
        } else {
            return response()->json([
                "success" => false,
                "message" => "File tidak ditemukan."
            ], 404); // Status HTTP 404 Not Found
        }
    }
    
}
