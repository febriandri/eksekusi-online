@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h3>PERMOHONAN EKSEKUSI</h3>
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
                    DAFTAR PERMOHONAN
                    <div class="float-end">
                        <a href="/permohonan/create" class="btn btn-primary btn-sm"><i class="fa-regular fa-plus"></i> Permohonan Baru</a>
                    </div>
                </h5>
                <table id="myTable" class="table table-stripped">
                    <thead>
                        <tr>
                            <th style="width: 3%">#</th>
                            <th>Judul</th>
                            <th>Eksekusi</th>
                            <th>Tanggal</th>
                            <th>Status</th>
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
        $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('permohonan.data') }}',
            aoColumnDefs : [{'bSortable': false, 'aTargets': [0]},{'bSearchable': false, 'aTargets': [0]}],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'nama', name: 'nama'},
                { data: 'jenisEksekusi', name: 'jenisEksekusi'},
                { data: 'tanggal', name: 'tanggal'},
                { data: 'status', name: 'status'},
                { data: 'aksi', name: 'aksi'}
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
                    url: '/permohonan/' + id,
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


{{-- coin apa yang paling bagus untuk di beli...?
liat grafik candle mingguan
jika break snr maka ada peluang untuk masuk
amati apakah harus menunggu pullback atau langsung masuk
jika masuk jangan langsung all in --}}
