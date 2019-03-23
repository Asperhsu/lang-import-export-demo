<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Asper\LangExcelConverter\Imports\TranslationsImport;

class ImportController extends Controller
{
    public function upload(Request $request)
    {
        $data = $request->validate([
            'file' => 'file|mimes:xlsx',
        ], [
            'required' => 'The :attribute field is required.',
            'file'     => 'The :attribute must be a file.',
            'mimes'    => 'The :attribute must be a file of type: :values.'
        ], [
            'file' => 'File',
        ]);

        $data['file']->storeAs('import', 'translations.xlsx');

        Excel::import(new TranslationsImport, 'import/translations.xlsx');

        session()->flash('msg', 'Success');

        return redirect()->route('home');
    }
}
