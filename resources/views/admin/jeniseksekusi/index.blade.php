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
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    JENIS EKSEKUSI
                    <div class="float-end">
                        <a href="/admin/jenis/eksekusi/create" class="btn btn-primary btn-sm"><i class="fa-regular fa-plus"></i> Jenis Eksekusi Baru</a>
                    </div>
                </h5>
                <table id="myTable" class="table table-stripped">
                    <thead>
                        <tr>
                            <th style="width: 3%">#</th>
                            <th>Eksekusi</th>
                            <th style="width: 5%">Detil</th>
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
        $('#myTable').DataTable(
            {
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.jenis.eksekusi.data') }}',
            aoColumnDefs : [{'bSortable': false, 'aTargets': [0]},{'bSearchable': false, 'aTargets': [0]}],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'nama', name: 'nama'},
                { data: 'persyaratan', name: 'persyaratan'},
                { data: 'aksi', name: 'aksi'}
            ]
        }
        );
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
                    url: '/admin/jenis/eksekusi/' + id,
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