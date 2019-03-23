<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Asper\LangExcelConverter\Exports\TranslationsExport;

class ExportController extends Controller
{
    public function upload(Request $request)
    {
        $data = $request->validate([
            'lang' => 'required',
            'file' => 'required|file',
        ], [
            'required' => 'The :attribute field is required.',
            'file'     => 'The :attribute must be a file.',
        ], [
            'lang' => 'Locale',
            'file' => 'File',
        ]);

        $extension = $data['file']->getClientOriginalExtension();
        $filename = $data['file']->getClientOriginalName();

        abort_if($extension !== 'php', 403);

        $data['file']->storeAs($data['lang'], $filename, 'lang');

        return $filename . ' is readed';
    }

    public function download(Request $request)
    {
        $filename = 'translations_' . date('Ymd_His') . '.xlsx';
        return Excel::download(new TranslationsExport, $filename);
    }
}
