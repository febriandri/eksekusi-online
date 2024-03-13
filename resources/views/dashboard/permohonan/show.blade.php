@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h3>DETAIL PERMOHONAN EKSEKUSI</h3>
</div>

@if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="row d-flex justify-content-center mt-4 mb-4">
    <div class="col-md-5">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title mb-4">DATA PERMOHONAN </h5>
                <p class="title">Permohonan :</p>{{ $permohonan->nama }}<hr/>
                <p class="title">No. HP/WA :</p>{{ $permohonan->no_hp }}<hr/>
                <p class="title">Eksekusi :</p>{{ $permohonan->jenisEksekusi->nama }}<hr/>
                @foreach ($permohonan->permohonanPersyaratan as $item)
                <p class="title">{{ $item->persyaratan->nama . ' :' }}</p><a href="{{ asset('storage/' . $item->isi) }}" target="_blank" class="text-decoration-none text-success">Lihat dokumen</a><hr/>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">PROGRES PERMOHONAN</h5>
                <div class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                    <div class="vertical-timeline-item vertical-timeline-element">
                        <span class="vertical-timeline-element-icon bounce-in">
                            <i class="badge badge-dot badge-dot-xl badge-success"></i>
                        </span>
                        <div class="vertical-timeline-element-content bounce-in">
                            <h4 class="timeline-title">Pengajuan Permohonan Eksekusi</h4>
                            <p>Pengajuan permohonan eksekusi secara online</p>
                            <span class="vertical-timeline-element-date">
                                {{ date('d/m/Y', strtotime($permohonan->created_at)) }} <br>
                                {{ date('H:i', strtotime($permohonan->created_at)) }} WIB
                            </span>
                        </div>
                    </div>

                    @foreach ($permohonan->prosesEksekusi as $proses_eksekusi)
                        <div class="vertical-timeline-item vertical-timeline-element">
                            <span class="vertical-timeline-element-icon bounce-in">
                                <i class="badge badge-dot badge-dot-xl badge-warning"> </i>
                            </span>
                            <div class="vertical-timeline-element-content bounce-in">
                                <h4 class="timeline-title">{{ $proses_eksekusi->tahapan->nama }}</h4>
                                @if ($proses_eksekusi->keterangan)
                                    {!! $proses_eksekusi->keterangan !!}
                                @endif

                                @foreach ($proses_eksekusi->prosesEksekusiKelengkapan as $item)
                                    @if ($item->isi)
                                        <p>{{ $item->kelengkapan->nama }} : <a href="{{ asset('storage/'.$item->isi) }}" target="_blank" class="text-decoration-none text-success">Lihat dokumen</a></p>
                                    @else
                                        <form class="row g-3" action="/proses/eksekusi/kelengkapan/{{ $item->id }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <span for="{{ 'isi' . $item->kelengkapan_id }}">{{ $item->kelengkapan->nama }} : </span>
                                            
                                            <div class="col-auto mt-0">
                                                <input class="form-control form-control-sm @error('isi') is-invalid @enderror" id="isi" name="isi" type="file" required>
                                                @error('isi')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-auto mt-0">
                                                <button type="submit" class="btn btn-primary btn-sm mb-3 float-end">Upload</button>
                                            </div>
                                        </form>
                                    @endif                                        
                                @endforeach
                                <span class="vertical-timeline-element-date">
                                    {{ date('d/m/Y', strtotime($proses_eksekusi->created_at)) }} <br>
                                    {{ date('H:i', strtotime($proses_eksekusi->created_at)) }} WIB
                                </span>
                            </div>
                        </div>                            
                    @endforeach
                </div>
            </div>
        </div>        
        
    </div>
</div>

@push('css')
    <style>
        .timeline {
            border-left: 1px solid hsl(0, 0%, 90%);
            position: relative;
            list-style: none;
        }

        .timeline .timeline-item {
            position: relative;
        }

        .timeline .timeline-item:after {
            position: absolute;
            display: block;
            top: 0;
        }

        .timeline .timeline-item:after {
            background-color: hsl(0, 0%, 90%);
            left: -38px;
            border-radius: 50%;
            height: 11px;
            width: 11px;
            content: "";
        }
    </style>
@endpush

@endsection