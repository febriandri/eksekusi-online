<?php

namespace App\Http\Controllers;

use App\Models\ProsesEksekusiKelengkapan;
use Illuminate\Http\Request;

class ProsesEksekusiKelengkapanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProsesEksekusiKelengkapan  $prosesEksekusiKelengkapan
     * @return \Illuminate\Http\Response
     */
    public function show(ProsesEksekusiKelengkapan $prosesEksekusiKelengkapan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProsesEksekusiKelengkapan  $prosesEksekusiKelengkapan
     * @return \Illuminate\Http\Response
     */
    public function edit(ProsesEksekusiKelengkapan $prosesEksekusiKelengkapan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProsesEksekusiKelengkapan  $prosesEksekusiKelengkapan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProsesEksekusiKelengkapan $kelengkapan)
    {
        $rules = ([
            'isi' => 'required|file|max:10240'
        ]);

        $validatedData = $request->validate($rules);

        if($request->file('isi')) {
            $validatedData['isi'] =  $request->file('isi')->store('kelengkapan');
        }

        ProsesEksekusiKelengkapan::where('id', $kelengkapan->id)->update($validatedData);

        return redirect()->back()->with('success', 'Data berhasil diupload!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProsesEksekusiKelengkapan  $prosesEksekusiKelengkapan
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProsesEksekusiKelengkapan $prosesEksekusiKelengkapan)
    {
        //
    }
}
