@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h3>TAMBAH TAHAPAN PERMOHONAN EKSEKUSI</h3>
</div>

<a href="/admin/permohonan/{{ $permohonan->slug }}" class="btn btn-sm btn-primary" role="button"><i class="fa-solid fa-rotate-left"></i> Kembali</a>

<div class="row d-flex justify-content-center mt-2 mb-4">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title mb-3">FORM TAMBAH</h5>
                <div class="col-lg-8">
                    <form action="/admin/permohonan/proses/eksekusi/{{ $permohonan->slug }}" method="post">
                        @csrf
                        @method('put')

                        <div class="mb-3">
                            <label for="nama" class="form-label">Permohonan</label>
                            <input type="text" class="form-control" value="{{ $permohonan->nama }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="tahapan_id" class="form-label">Tahapan</label>
                            <select class="form-select @error('tahapan_id') is-invalid @enderror" name="tahapan_id" id="tahapan_id">
                                <option value="" selected>Pilih</option>
                                @foreach ($tahapans as $tahapan)
                                    <option value="{{ $tahapan->id }}">{{ $tahapan->nama }}</option>
                                @endforeach                                
                            </select>
                            @error('tahapan_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror 
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="hidden" id="keterangan" name="keterangan">
                            <trix-editor input="keterangan"></trix-editor>
                        </div>

                        <div class="row col-sm-12 mb-3">
                            <label for="tahapan_id" class="form-label">Kelengkapan berkas / dokumen</label>
                            <div class="col-sm-11">
                                <div class="form-group">
                                    <select class="form-control" name="kelengkapan_id[]" id="kelengkapan_id" style="width:100%;">
                                        <option selected value="">Tidak Ada</option>
                                        @foreach ($kelengkapans as $kelengkapan)
                                            <option value="{{ $kelengkapan->id }}">{{ $kelengkapan->nama }}</option>
                                        @endforeach  
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <a class="btn btn-flat btn-sm btn-success" id="add" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>

                        <div id="dynamic_field"></div>
                        
                        <button type="submit" class="btn btn-primary mb-3 float-end"><i class="fa-regular fa-floppy-disk"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        });
        
        $(function() {
        
            var z=2;  
            $('#add').click(function(){                  
                $('#dynamic_field').append('<div id="rowpermintaan'+z+'"><div class="row col-sm-12 mb-3"><div class="col-sm-11"><div class="form-group"><select class="form-control" name="kelengkapan_id[]" id="value" style="width:100%; " required><option selected>Tidak Ada</option>@foreach ($kelengkapans as $kelengkapan)<option value="{{ $kelengkapan->id }}">{{ $kelengkapan->nama }}</option>@endforeach </select></div></div><div class="col-sm-1"><button type="button" name="remove" id="'+z+'" class="btn btn-danger btn-sm btn_remove"><i class="fa fa-times"></i></button></div></div></div>');
                z++;
            });  
        
            $(document).on('click', '.btn_remove', function(){  
                var button_id = $(this).attr("id");   
                $('#rowpermintaan'+button_id+'').remove();  
            });
        });
    </script>
@endpush
@endsection