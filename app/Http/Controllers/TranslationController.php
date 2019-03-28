<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Asper\LangExcelConverter\Services\TranslationManager;

class TranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TranslationManager $manager)
    {
        $groups = $manager->groups();

        return view('translation.index', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, TranslationManager $manager)
    {
        $data = $request->validate([
            'trans' => 'required|array',
        ]);

        $manager->set($data['trans'])->save();

        return redirect()->route('translation.index');
    }
}
