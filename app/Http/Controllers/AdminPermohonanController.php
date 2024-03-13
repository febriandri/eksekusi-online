<?php

namespace App\Http\Controllers;

use App\Models\Tahapan;
use App\Models\Permohonan;
use App\Models\Kelengkapan;
use Illuminate\Http\Request;
use App\Models\ProsesEksekusi;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Models\ProsesEksekusiKelengkapan;

class AdminPermohonanController extends Controller
{
    public function index()
    {
        return view('admin.permohonan.index');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $permohonan = Permohonan::latest();
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
                return '<a href="/admin/permohonan/'. $permohonan->slug .'" class="badge bg-success"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></a>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
        } else {
            exit("Not an AJAX request -_-");
        }
    }

    public function dataProsesEksekusi(Request $request)
    {
        if ($request->ajax()) {
            $permohonanId = $request->input('permohonanId');
            $data = ProsesEksekusi::where('permohonan_id', $permohonanId)->oldest();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('tanggal', function($data){
                return date('d/m/Y', strtotime($data->created_at));
            })
            ->addColumn('tahapan', function($data){
                return $data->tahapan->nama;
            })
            ->addColumn('kelengkapan', function($data){
                return with(new ProsesEksekusiKelengkapan)->prosesEksekusiKelengkapanDetail($data->id);
            })
            ->addColumn('aksi', function ($data) {
                return '<a onclick="deleteData('. $data->id .')" href="#hapus" class="badge bg-danger"><i class="fa fa-trash"></i></a>';
            })
            ->rawColumns(['keterangan', 'kelengkapan', 'aksi'])
            ->make(true);
        } else {
            exit("Not an AJAX request -_-");
        }
    }
    
    public function show(Permohonan $permohonan)
    {
        return view('admin.permohonan.show', [
            'permohonan' => $permohonan
        ]);
    }

    public function createProsesEksekusi(Permohonan $permohonan)
    {
        return view('admin.permohonan.create-proses-eksekusi', [
            'permohonan' => $permohonan,
            'tahapans' => Tahapan::where('jenis_eksekusi_id', $permohonan->jenis_eksekusi_id)->get(),
            'kelengkapans' => Kelengkapan::all()
        ]);
    }

    public function storeProsesEksekusi(Request $request, Permohonan $permohonan)
    {
        $rules = ([
            'tahapan_id' => 'required',
        ]);

        if($request->keterangan) {
            $rules['keterangan'] = 'required';
        }

        $customMessages = [
            'required' => 'Harap bagian ini di isi.',
            'mimes' => 'Dokumen harus berupa pdf atau jpg'
        ];

        $validatedData = $this->validate($request, $rules, $customMessages);
        
        $prosesEksekusi = $permohonan->prosesEksekusi()->create($validatedData);

        if (!is_null($request->kelengkapan_id[0])) {
            foreach ($request->kelengkapan_id as $item) {
                $prosesEksekusi->prosesEksekusiKelengkapan()->create([
                    'kelengkapan_id' => $item,
                ]);
            }
        }
        
        return redirect("/admin/permohonan/$permohonan->slug")->with('success', 'Data berhasil disimpan!');
    }

    public function destroyProsesEksekusi(ProsesEksekusi $prosesEksekusi)
    {
        foreach ($prosesEksekusi->prosesEksekusiKelengkapan as $item) {
            Storage::delete($item->isi);
        }

        ProsesEksekusiKelengkapan::where('proses_eksekusi_id', $prosesEksekusi->id)->delete();

        return ProsesEksekusi::destroy($prosesEksekusi->id);
    }
}
