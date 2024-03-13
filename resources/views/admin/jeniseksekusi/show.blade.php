@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h3>DAFTAR JENIS EKSEKUSI</h3>
</div>

@if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="row d-flex justify-content-center mt-4 mb-4">
    <div class="col-md-6">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    PERSYARATAN EKSEKUSI
                    <div class="float-end">
                        <a href="/admin/jenis/eksekusi/{{ $eksekusi->id }}/persyaratan/create" class="btn btn-primary btn-sm"><i class="fa-regular fa-plus"></i> Persyaratan Baru</a>
                    </div>
                </h5>
                <table id="myTable" class="table table-stripped">
                    <thead>
                        <tr>
                            <th style="width: 3%">#</th>
                            <th>Persyaratan</th>
                            <th style="width: 5%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>  
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    TAHAPAN EKSEKUSI
                    <div class="float-end">
                        <a href="/admin/jenis/eksekusi/{{ $eksekusi->id }}/tahapan/create" class="btn btn-primary btn-sm"><i class="fa-regular fa-plus"></i> Tahapan Baru</a>
                    </div>
                </h5>
                <table id="tableTahapan" class="table table-stripped">
                    <thead>
                        <tr>
                            <th style="width: 3%">#</th>
                            <th>Tahapan</th>
                            <th style="width: 5%">Aksi</th>
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
        var jenisEksekusiId = "{{ $eksekusi->id }}";
        $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.jenis.eksekusi.persyaratan.data') }}",
                data: { jenisEksekusiId : jenisEksekusiId }
            },
            aoColumnDefs : [{'bSortable': false, 'aTargets': [0]},{'bSearchable': false, 'aTargets': [0]}],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'nama', name: 'nama'},
                { data: 'aksi', name: 'aksi'}
            ]
        });
    });

    $(document).ready( function () {
        var jenisEksekusiId = "{{ $eksekusi->id }}";
        $('#tableTahapan').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.jenis.eksekusi.tahapan.data') }}",
                data: { jenisEksekusiId : jenisEksekusiId }
            },
            aoColumnDefs : [{'bSortable': false, 'aTargets': [0]},{'bSearchable': false, 'aTargets': [0]}],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'nama', name: 'nama'},
                { data: 'aksi', name: 'aksi'}
            ]
        });
    });

    function deleteDataPersyaratan(id){
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
                    url: '/admin/jenis/eksekusi/' + id + '/persyaratan',
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

    function deleteDataTahapan(id){
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
                    url: '/admin/jenis/eksekusi/' + id + '/tahapan',
                    type: "POST",
				    data: {'_method' : 'DELETE', "_token": "{{ csrf_token() }}"},
                    success: function(data) {
                        $('#tableTahapan').DataTable().ajax.reload();
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