<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use Chumper\Zipper\Facades\Zipper;

class LangController extends Controller
{
    public function clear(Request $request)
    {
        foreach (Storage::disk('lang')->allDirectories() as $dir) {
            Storage::disk('lang')->cleanDirectory($dir);
        }

        return redirect()->route('home');
    }

    public function download(Request $request, Filesystem $filesystem)
    {
        $outputFile = storage_path(sprintf('app/lang_%s.zip', date('Ymd_His')));

        Zipper::make($outputFile)->add(resource_path('lang'))->close();

        return response()->download($outputFile)->deleteFileAfterSend(true);
    }
}
