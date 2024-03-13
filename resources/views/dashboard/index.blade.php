@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3>DASHBOARD</h3>
    </div>

    <div class="row d-flex justify-content-center mt-4 mb-4">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    Selamat datang {{ $nama }}...
                </div>
            </div>
        </div>
    </div>
      
@endsection