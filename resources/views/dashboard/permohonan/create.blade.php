@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h3>TAMBAH PERMOHONAN EKSEKUSI</h3>
</div>

<div class="row d-flex justify-content-center mt-4 mb-4">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title mb-3">FORM TAMBAH</h5>
                <div class="col-lg-8">
                    <form action="/permohonan" method="post" enctype="multipart/form-data" autocomplete="off">
                        @csrf

                        <div class="mb-3">
                            <label for="nama" class="form-label">Permohonan</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" autofocus>
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror 
                        </div>

                        <div class="mb-3">
                            <label for="no_hp" class="form-label">Nomor HP / WA</label>
                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp') }}">
                            @error('no_hp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror 
                        </div>
                        
                        <input type="hidden" class="form-control" id="slug" name="slug" required value="{{ old('slug') }}" readonly> 

                        <div class="mb-3">
                            <label for="jenis_eksekusi_id" class="form-label">Jenis Eksekusi</label>
                            <select class="form-select" name="jenis_eksekusi_id" id="jenis_eksekusi_id" required>
                                <option value="" selected>Pilih</option>
                                @foreach ($jenisEksekusis as $jenisEksekusi)
                                    @if (old('jenis_eksekusi_id') == $jenisEksekusi->id)
                                        <option value="{{ $jenisEksekusi->id }}" selected>{{ $jenisEksekusi->nama }}</option>    
                                    @else    
                                        <option value="{{ $jenisEksekusi->id }}">{{ $jenisEksekusi->nama }}</option>
                                    @endif
                                @endforeach                                
                            </select>
                        </div>
                        
                        <img id="loading-image" src="/img/ajax-loader.gif" style="display:none;"/>
                        <div id="persyaratan"></div>

                        <button type="submit" class="btn btn-primary mb-3 float-end"><i class="fa-regular fa-floppy-disk"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')    
<script>
    const nama = document.querySelector('#nama');
    const slug = document.querySelector('#slug');

    nama.addEventListener('change', function() {
        fetch('/permohonan/checkSlug?nama=' + nama.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });

    const persyaratan = document.querySelector('#jenis_eksekusi_id');

    if (persyaratan.value) {
        $("#persyaratan").empty();
        $(document).ready(function (){
            addPersyaratan();
        });
    }

    persyaratan.addEventListener('change', function() {
        $("#persyaratan").empty();
        if (persyaratan.value) {
            addPersyaratan();
        }
    });

    function addPersyaratan() {
        $.ajax({
            url : "/permohonan/persyaratan/" + $( "#jenis_eksekusi_id" ).val(),
            type: 'GET',
            dataType: 'json',
            beforeSend: function() {
                $("#loading-image").show();
            },
            success: function(response) {
                $.each(response,function(key, value)
                {
                    const required = value.wajib_diisi == 1 ? "required" : "";
                    $("#persyaratan").append('<div class="mb-3"><label class="form-label">' + value.nama + '</label><input type="hidden" class="form-control" id="persyaratan_id[]" name="persyaratan_id[]" value="' + value.id + '" required readonly><input type="file" class="form-control @error("isi.*") is-invalid @enderror" id="isi[]" name="isi[]" '+ required +'>@error("isi.*")<div class="invalid-feedback">{{ $message }}</div>@enderror<div class="form-text fst-italic">Dokumen ekstensi ' + value.ekstensi + '</div></div>');
                });
                $("#loading-image").hide();
            }
        });
    }
</script>
@endpush

@endsection