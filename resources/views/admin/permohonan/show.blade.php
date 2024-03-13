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

<div class="row d-flex justify-content-center mt-2 mb-4">
    <div class="col-md-4">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">DATA PERMOHONAN EKSEKUSI</h5>
                <p class="title">Permohonan :</p>{{ $permohonan->nama }}<hr/>
                <p class="title">Eksekusi :</p>{{ $permohonan->jenisEksekusi->nama }}<hr/>
                @foreach ($permohonan->permohonanPersyaratan as $item)
                <p class="title">{{ $item->persyaratan->nama . ' :' }}</p><a href="{{ asset('storage/' . $item->isi) }}" target="_blank" class="text-decoration-none text-success">Lihat dokumen</a><hr/>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title mb-3">PROGRES PERMOHONAN EKSEKUSI</h5>
                <p><a href="/admin/permohonan/proses/eksekusi/{{ $permohonan->slug }}/create" class="btn btn-primary btn-sm"><i class="fa-regular fa-plus"></i> Buat Tahapan Baru</a></p>
                <table id="myTable" class="table table-stripped">
                    <thead>
                        <tr>
                            <th style="width: 3%">#</th>
                            <th>Tahapan</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Kelengkapan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>  
                    </tbody>
                </table>
            </div>
        </div>        
    </div>
</div>

@push('js')
<script>
    $(document).ready( function () {
        var permohonanId = "{{ $permohonan->id }}";
        $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.permohonan.dataProsesEksekusi') }}",
                data: { permohonanId : permohonanId }
            },
            aoColumnDefs : [{'bSortable': false, 'aTargets': [0]},{'bSearchable': false, 'aTargets': [0]}],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'tahapan', name: 'tahapan'},
                { data: 'tanggal', name: 'tanggal'},
                { data: 'keterangan', name: 'keterangan'},
                { data: 'kelengkapan', name: 'kelengkapan'},
                { data: 'aksi', name: 'aksi'},
            ]
        });
    } );

    function deleteData(id){
        Swal.fire({
            title: 'Apakah anda yakin ?',
            text: "untuk menghapus data ini..!",
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then(function(result) {
            if (result.value)
            {
                $.ajax({
                    url: '/admin/permohonan/proses/eksekusi/' + id,
                    type: "POST",
				    data: {'_method' : 'DELETE', "_token": "{{ csrf_token() }}"},
                    success: function(data) {
                        $('#myTable').DataTable().ajax.reload();
                        Swal.fire({
                            title: 'Berhasil...',
                            text: 'Data telah dihapus..!',
                            type: 'success',
                            timer: 1500
                        });
                    },
                    error: function(){
                        Swal.fire({
                            title: 'Maaf...',
                            text: 'Terjadi kesalahan. Silahkan coba lagi..!',
                            type: 'error',
                            timer: 1500
                        });
                    }
                });
            }
        });
    }
</script>
@endpush
@endsection