@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h3>EDIT PERMOHONAN EKSEKUSI</h3>
</div>

<div class="row d-flex justify-content-center mt-4 mb-4">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title mb-3">FORM EDIT</h5>
                <div class="col-lg-8">
                    <form action="/permohonan/{{ $permohonan->slug }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Permohonan</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" required autofocus value="{{ old('nama', $permohonan->nama) }}">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No. HP/WA</label>
                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" required value="{{ old('no_hp', $permohonan->no_hp) }}">
                            @error('no_hp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <input type="hidden" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" required value="{{ old('slug', $permohonan->slug) }}" readonly>

                        @foreach ($permohonan->permohonanPersyaratan as $item)
                            <div class="mb-3">
                                <label class="form-label">{{ $item->persyaratan->nama }}</label> <i>(Klik disini untuk <a href="{{ asset('storage/' . $item->isi) }}" target="_blank" class="text-decoration-none">Lihat dokumen</a>)</i>
                                <input type="hidden" name="persyaratan_id[]" value="{{ $item->persyaratan_id }}">
                                <input type="hidden" name="oldIsi[]" value="{{ $item->isi }}">
                                <input type="file" class="form-control @error('isi.*') is-invalid @enderror" id="isi[]" name="isi[]" required">
                                <div class="form-text fst-italic">Dokumen ekstensi .pdf</div>
                                @error('isi.*')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        @endforeach

                        <button type="submit" class="btn btn-primary float-end"><i class="fa-regular fa-floppy-disk"></i> Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    const nama = document.querySelector('#nama');
    const slug = document.querySelector('#slug');

    nama.addEventListener('change', function() {
        fetch('/permohonan/checkSlug?nama=' + nama.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });

    function previewImage() {
        const image_ktp = document.querySelector('#image_ktp');
        const imgPreview =document.querySelector('.img-preview');

        imgPreview.style.display= 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image_ktp.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endsection