<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class SecureFileController extends Controller
{
    public function showPrivateFile($encryptedFilename)
    {


        try {
            // Decrypt the filename safely
            // $relativePath = Crypt::decrypt(payload: $encryptedFilename);
            $relativePath = $encryptedFilename;

            // dd(storage_path("app/private/" . $relativePath));
        } catch (\Exception $e) {
            abort(403, "Unauthorized access.");
        }

        if (
            !Auth::guard('admin')->check() &&
            !Auth::guard('patient')->check() &&
            !Auth::guard('navigator')->check()
        ) {
            abort(403, "Unauthorized access.");
        }

        // Ensure the file exists in storage
        $fullPath = storage_path("app/private/" . $relativePath);

        if (!file_exists($fullPath)) {
            abort(404, "File not found.");
        }

        // Serve the file securely
        return response()->file($fullPath);
    }


}