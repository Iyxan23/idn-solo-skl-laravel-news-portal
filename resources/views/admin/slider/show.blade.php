@extends('admin.parent')

@section('pagetitle')
    <div class="pagetitle">
      <h1>Show Slider</h1>
      <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('slider.index') }}">Slider</a></li>
            <li class="breadcrumb-item active">{{ $slider->title }}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
@endsection

@section('content')
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="card-title">{{ $slider->title }}</div>

          @if ($errors->any())
              @foreach($errors->all() as $error)
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <i class="bi bi-exclamation-octagon me-1"></i>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              @endforeach
          @endif

            <div class="col-md-12">
              <label for="imageInput" class="form-label">Image</label>
              <img src="{{ $slider->image }}" alt="" class="img-thumbnail w-25" />
            </div>
            <div class="col-md-12">
              <label for="urlInput" class="form-label">URL</label>
              <input type="text" class="form-control" id="urlInput" name="url" value="{{ $slider->url }}" readonly>
            </div>
            
            <div class="text-center">
              <a href="{{ route('slider.edit', $slider->id) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i>
                Edit
              </a>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection