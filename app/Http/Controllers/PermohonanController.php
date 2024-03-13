<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use App\Models\Persyaratan;
use Illuminate\Http\Request;
use App\Models\JenisEksekusi;
use App\Models\PermohonanPersyaratan;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PermohonanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.permohonan.index', [
            'permohonan' => Permohonan::where('user_id', auth()->user()->id)->latest()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.permohonan.create', [
            'jenisEksekusis' => JenisEksekusi::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'jenis_eksekusi_id' => 'required',
            'nama' => 'required|max:255',
            'no_hp' => 'required|numeric',
            'slug' => 'required|unique:permohonans'
            // 'isi.*' => 'file|mimes:pdf,jpg,jpeg|max:1024'
        ];

        // dd($request);

        $persyaratanEksekusi = Persyaratan::where('jenis_eksekusi_id', $request->jenis_eksekusi_id)->get();

        foreach ($persyaratanEksekusi as $key=>$item) {

            $required = ($item->wajib_diisi == 1) ? 'required|' : '';

            $rules["isi.$key"] = $required.'file|mimes:pdf,jpg,jpeg|max:1024';
        }
    
        $customMessages = [
            'required' => 'Harap bagian ini di isi.',
            'mimes' => 'Dokumen harus berupa pdf atau jpg',
            "isi.*.max" => 'Ukuran dokumen maksimal 10 MB'
        ];
    
        $validatedData = $this->validate($request, $rules, $customMessages);

        if ($request->file('isi')) {

            $validatedData['user_id'] = auth()->user()->id;

            $permohonan = Permohonan::create($validatedData);

            foreach ($request->file('isi') as $key=>$item) {
                $permohonan->permohonanPersyaratan()->create([
                    'persyaratan_id' => $request->persyaratan_id[$key],
                    'isi' => $item->store('persyaratan')
                ]);
            }
        }

        return redirect('/permohonan')->with('success', 'Data baru telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permohonan  $permohonan
     * @return \Illuminate\Http\Response
     */
    public function show(Permohonan $permohonan)
    {
        return view('dashboard.permohonan.show', [
            'permohonan' => $permohonan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permohonan  $permohonan
     * @return \Illuminate\Http\Response
     */
    public function edit(Permohonan $permohonan)
    {
        return view('dashboard.permohonan.edit', [
            'permohonan' => $permohonan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permohonan  $permohonan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permohonan $permohonan)
    {
        $rules = [
            'nama' => 'required|max:255',
            'no_hp' => 'required|numeric',
            'isi.*' => 'file|mimes:pdf,jpg,jpeg|max:1024'
        ];

        if($request->slug != $permohonan->slug) {
            $rules['slug'] = 'required|unique:permohonans';
        }
    
        $customMessages = [
            'required' => 'Harap bagian ini di isi.',
            'mimes' => 'Dokumen harus berupa pdf atau jpg'
        ];
    
        $this->validate($request, $rules, $customMessages);

        $updateData = Permohonan::find($permohonan->id);

        $updateData->nama = $request->nama;
        $updateData->no_hp = $request->no_hp;
        $updateData->slug = $request->slug;

        $updateData->save();

        if ($request->file('isi')) {
            foreach ($request->file('isi') as $key=>$item) {
                Storage::delete($request->oldIsi[$key]);
                $isi = $item->store('persyaratan');
                PermohonanPersyaratan::where(['permohonan_id' => $permohonan->id, 'persyaratan_id' => $request->persyaratan_id[$key]])->update(['isi' => $isi]);
            }
        }

        return redirect('/permohonan')->with('success', 'Data telah diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permohonan  $permohonan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permohonanPersyaratans = PermohonanPersyaratan::where('permohonan_id', $id);
        foreach ($permohonanPersyaratans->get() as $permohonanPersyaratan) {
            Storage::delete($permohonanPersyaratan->isi);
        }

        $permohonanPersyaratans->delete();
        
        return Permohonan::destroy($id);
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $permohonan = Permohonan::where('user_id', auth()->user()->id)->latest();
            return Datatables::of($permohonan)
            ->addIndexColumn()
            ->addColumn('jenisEksekusi', function($permohonan){
                return $permohonan->jenisEksekusi->nama;
            })
            ->addColumn('tanggal', function($permohonan){
                return date('d/m/Y', strtotime($permohonan->created_at));
            })
            ->addColumn('status', function($permohonan){
                return (count($permohonan->prosesEksekusi)>0) ? $permohonan->latestProsesEksekusi->tahapan->nama : 'Pengajuan Permohonan Eksekusi';
            })
            ->addColumn('aksi', function ($permohonan) {
                return '<a href="/permohonan/'. $permohonan->slug .'" class="badge bg-info"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></a> <a href="/permohonan/'. $permohonan->slug .'/edit" class="badge bg-warning"><i class="fa-solid fa-pencil"></i></a> <a onclick="deleteData('. $permohonan->id .')" href="#hapus-'. $permohonan->slug .'" class="badge bg-danger"><i class="fa fa-trash"></i></a>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
        } else {
            exit("Not an AJAX request -_-");
        }
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Permohonan::class, 'slug', $request->nama);

        return response()->json(['slug' => $slug]);
    }

    public function getJenisEksekusi($id)
    {
        $persyaratan = Persyaratan::where('jenis_eksekusi_id', $id)->get();

        return json_encode($persyaratan);
    }
}
