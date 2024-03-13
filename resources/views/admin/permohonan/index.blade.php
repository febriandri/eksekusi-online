@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h3>DAFTAR PERMOHONAN EKSEKUSI</h3>
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
                <h5 class="card-title mb-3">EKSEKUSI PUTUSAN </h5>
                <table id="myTable" class="table table-stripped">
                    <thead>
                        <tr>
                            <th style="width: 3%">#</th>
                            <th>Judul</th>
                            <th>Eksekusi</th>
                            <th>Tanggal</th>
                            <th>Status Permohonan</th>
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
            ajax: '{{ route('admin.permohonan.data') }}',
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
</script>
@endpush
@endsection