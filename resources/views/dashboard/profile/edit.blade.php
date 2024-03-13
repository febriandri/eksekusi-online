@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h3>EDIT PROFILE</h3>
</div>

<div class="row d-flex justify-content-center mt-4 mb-4">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title mb-3">FORM EDIT</h5>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif
                <form class="form-horizontal" method="POST" action="{{ route('changePasswordPost') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }} mb-3">
                        <label for="new-password" class="col-md-4 control-label">Password Saat Ini</label>
                        <div class="col-lg-8">
                            <input id="current-password" type="password" class="form-control" name="current-password" required>
                            @if ($errors->has('current-password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('current-password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }} mb-3">
                        <label for="new-password" class="col-md-4 control-label">Password Baru</label>
                        <div class="col-lg-8">
                            <input id="new-password" type="password" class="form-control" name="new-password" required>
                            @if ($errors->has('new-password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('new-password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="new-password-confirm" class="col-md-4 control-label">Konfirmasi Password Baru</label>
                        <div class="col-lg-8">
                            <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary float-end">
                                <i class="fa-regular fa-floppy-disk"></i> Edit Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection