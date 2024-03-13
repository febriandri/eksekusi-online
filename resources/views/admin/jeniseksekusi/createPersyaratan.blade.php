@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h3>TAMBAH PERSYARATAN EKSEKUSI</h3>
</div>

<div class="row d-flex justify-content-center mt-4 mb-4">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title mb-3">FORM TAMBAH</h5>
                <div class="col-lg-8">
                    <form action="/admin/jenis/eksekusi/{{ $eksekusi->id }}/persyaratan" method="post" autocomplete="off">
                        @csrf
                        @method('put')

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" autofocus>
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror 
                        </div>

                        <div class="mb-3">
                            <label for="wajib_diisi" class="form-label">Wajib diisi</label>
                            <select class="form-select @error('wajib_diisi') is-invalid @enderror" name="wajib_diisi" id="wajib_diisi">
                                <option value="" selected>Pilih</option>
                                <option value="1">Ya</option>      
                                <option value="0">Tidak</option>                             
                            </select>
                            @error('wajib_diisi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror 
                        </div>

                        <button type="submit" class="btn btn-primary mb-3 float-end"><i class="fa-regular fa-floppy-disk"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection