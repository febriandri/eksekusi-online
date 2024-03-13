<?php

namespace App\Http\Controllers;

use App\Models\Kelengkapan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminKelengkapanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.kelengkapan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kelengkapan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:25'
        ]);

        Kelengkapan::create($validatedData);

        return redirect('/admin/kelengkapan')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelengkapan $kelengkapan)
    {
        Kelengkapan::destroy($kelengkapan->id);
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data =   Kelengkapan::all();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('nama', function ($data) {
                return $data->nama;
            })
            ->addColumn('aksi', function ($data) {
                return '<center><a onclick="deleteData('. $data->id .')" href="#hapus-'. $data->id .'" class="badge bg-danger"><i class="fa fa-trash"></i></a></center>';
            })
            ->rawColumns(['nama', 'aksi'])
            ->make(true);
        } else {
            exit("Not an AJAX request -_-");
        }
    }
}
