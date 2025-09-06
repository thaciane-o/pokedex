<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads', 'public');
            return response()->json(['path' => $path, 'url' => Storage::url($path)]);
        }
        return response()->json(['error' => 'Nenhum arquivo recebido'], 400);
    }

    public function remove(Request $request)
    {
        $path = $request->input('path');

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
            return response()->json(['removed' => true]);
        }
        return response()->json(['error' => 'Arquivo não encontrado'], 404);
    }

}
