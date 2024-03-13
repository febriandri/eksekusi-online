<?php

namespace App\Http\Controllers;

use App\Models\JenisEksekusi;
use App\Models\Persyaratan;
use App\Models\Tahapan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminJenisEksekusiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.jeniseksekusi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jeniseksekusi.create');
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
            'nama' => 'required|max:255'
        ]);
        
        JenisEksekusi::create($validatedData);

        return redirect('/admin/jenis/eksekusi')->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JenisEksekusi  $jenisEksekusi
     * @return \Illuminate\Http\Response
     */
    public function show(JenisEksekusi $eksekusi)
    {
        return view('admin.jeniseksekusi.show', [
            'eksekusi' => $eksekusi
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JenisEksekusi  $jenisEksekusi
     * @return \Illuminate\Http\Response
     */
    public function edit(JenisEksekusi $eksekusi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JenisEksekusi  $jenisEksekusi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JenisEksekusi $eksekusi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JenisEksekusi  $jenisEksekusi
     * @return \Illuminate\Http\Response
     */
    public function destroy(JenisEksekusi $eksekusi)
    {
        return JenisEksekusi::destroy($eksekusi->id);
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data =   JenisEksekusi::all();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('persyaratan', function ($data) {
                return '<center><a href="/admin/jenis/eksekusi/'. $data->id .'"><i class="fa fa-external-link text-info"></i></a></center>';
            })
            ->addColumn('aksi', function ($data) {
                return '<center><a onclick="deleteData('. $data->id .')" href="#hapus-'. $data->id .'" class="badge bg-danger"><i class="fa fa-trash"></i></a></center>';
            })
            ->rawColumns(['persyaratan', 'aksi'])
            ->make(true);
        } else {
            exit("Not an AJAX request -_-");
        }
    }

    public function dataPersyaratan(Request $request)
    {
        if ($request->ajax()) {
            $jenisEksekusiId = $request->input('jenisEksekusiId');
            $data = Persyaratan::where('jenis_eksekusi_id', $jenisEksekusiId)->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                return '<center><a onclick="deleteDataPersyaratan('. $data->id .')" href="#hapus-'. $data->id .'" class="badge bg-danger"><i class="fa fa-trash"></i></a></center>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
        } else {
            exit("Not an AJAX request -_-");
        }
    }

    public function dataTahapan(Request $request)
    {
        if ($request->ajax()) {
            $jenisEksekusiId = $request->input('jenisEksekusiId');
            $data = Tahapan::where('jenis_eksekusi_id', $jenisEksekusiId)->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                return '<center><a onclick="deleteDataTahapan('. $data->id .')" href="#hapus-'. $data->id .'" class="badge bg-danger"><i class="fa fa-trash"></i></a></center>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
        } else {
            exit("Not an AJAX request -_-");
        }
    }

    public function createPersyartan(JenisEksekusi $eksekusi)
    {
        return view('admin.jeniseksekusi.createPersyaratan', [
            'eksekusi' => $eksekusi
        ]);
    }

    public function createTahapan(JenisEksekusi $eksekusi)
    {
        return view('admin.jeniseksekusi.createTahapan', [
            'eksekusi' => $eksekusi
        ]);
    }

    public function storePersyaratan(Request $request, JenisEksekusi $eksekusi)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'wajib_diisi' => 'required'
        ]);

        $validatedData['jenis_eksekusi_id'] = $eksekusi->id;
        $validatedData['ekstensi'] = 'pdf, jpg';

        Persyaratan::create($validatedData);

        return redirect("/admin/jenis/eksekusi/$eksekusi->id")->with('success', 'Data berhasil disimpan!');
    }

    public function storeTahapan(Request $request, JenisEksekusi $eksekusi)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255'
        ]);

        $validatedData['jenis_eksekusi_id'] = $eksekusi->id;

        Tahapan::create($validatedData);

        return redirect("/admin/jenis/eksekusi/$eksekusi->id")->with('success', 'Data berhasil disimpan!');
    }

    public function destroyPersyaratan($id)
    {       
        return Persyaratan::destroy($id);
    }

    public function destroyTahapan($id)
    {       
        return Tahapan::destroy($id);
    }
}
