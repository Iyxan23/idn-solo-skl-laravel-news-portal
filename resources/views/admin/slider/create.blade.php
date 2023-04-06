@extends('admin.parent')

@section('pagetitle')
    <div class="pagetitle">
      <h1>Create Slider</h1>
      <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('slider.index') }}">Slider</a></li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
@endsection

@section('content')
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="card-title">Add a new Slider item</div>

          @if ($errors->any())
              @foreach($errors->all() as $error)
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <i class="bi bi-exclamation-octagon me-1"></i>
                      {{ $error }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              @endforeach
          @endif

          <form class="row g-3" action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="col-md-12">
              <label for="titleInput" class="form-label">Title</label>
              <input type="text" class="form-control" id="titleInput" name="title" value="{{ old('title') }}" required>
            </div>
            <div class="col-md-12">
              <label for="descriptionInput" class="form-label">Description</label>
              <input type="text" class="form-control" id="descriptionInput" name="description" value="{{ old('description') }}" required>
            </div>
            <div class="col-md-12">
              <label for="imageInput" class="form-label">Image</label>
              <input type="file" class="form-control" id="imageInput" name="image" value="{{ old('image') }}" required>
            </div>
            <div class="col-md-12">
              <label for="urlInput" class="form-label">URL</label>
              <input type="text" class="form-control" id="urlInput" name="url" value="{{ old('url') }}" required>
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