@extends('admin.parent')

@section('content')

@if ($errors->any())
@foreach($errors->all() as $error)
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-octagon me-1"></i> {{ $error }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endforeach
@endif

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Change Password</h5>
        
        <form class="row g-3" action="{{ route('profile.update-password') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="col-12">
                <label for="inputCurPassword" class="form-label">Current Password</label>
                <input type="password" class="form-control" id="inputCurPassword" name="current_password" required>
            </div>
            <div class="col-12">
                <label for="inputNewPassword" class="form-label">New Password</label>
                <input type="password" class="form-control" id="inputNewPassword" name="new_password" value="{{ old('new_password') }}" required>
            </div>
            <div class="col-12">
                <label for="inputConfirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="inputConfirmPassword" name="confirm_password" value="{{ old('confirm_password') }}" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        
    </div>
</div>

@endsection