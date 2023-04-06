@extends('admin.parent')

@section('pagetitle')
    <div class="pagetitle">
      <h1>Edit Slider</h1>
      <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('slider.index') }}">Slider</a></li>
            <li class="breadcrumb-item"><a href="{{ route('slider.show', $slider->id) }}">{{ $slider->title }}</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
@endsection

@section('content')
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="card-title">Edit {{ $slider->title }}</div>

          @if ($errors->any())
              @foreach($errors->all() as $error)
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <i class="bi bi-exclamation-octagon me-1"></i>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              @endforeach
          @endif

          <form class="row g-3" action="{{ route('slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="col-md-12">
              <label for="imageInput" class="form-label">Image</label>
              <input type="file" class="form-control" id="imageInput" name="image" value="{{ $slider->image }}">
            </div>
            <div class="col-md-12">
              <label for="urlInput" class="form-label">URL</label>
              <input type="text" class="form-control" id="urlInput" name="url" value="{{ $slider->url }}" required>
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection