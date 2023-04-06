@extends('admin.parent')

@section('pagetitle')
    <div class="pagetitle">
      <h1>Show News</h1>
      <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('news.index') }}">News</a></li>
            <li class="breadcrumb-item active">{{ $news->title }}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
@endsection

@section('content')
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="card-title">{{ $news->title }}</div>

          @if ($errors->any())
              @foreach($errors->all() as $error)
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <i class="bi bi-exclamation-octagon me-1"></i>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              @endforeach
          @endif

            <div class="col-md-12">
              <label for="titleInput" class="form-label">Title</label>
              <input type="text" class="form-control" id="titleInput" name="title" value="{{ $news->title }}" readonly>
            </div>
            <div class="col-md-12">
              <label for="imageInput" class="form-label">Image</label>
              <img src="{{ $news->image }}" alt="" class="img-thumbnail w-25" />
            </div>
            <div class="col-md-4">
              <label for="categoryInput" class="form-label">Category</label>
              <select id="categoryInput" class="form-select" name="category">
                <option selected value="{{ $news->category->id }}">{{ $news->category->name }}</option>
              </select>
            </div>
            <div class="col-md-12">
              <label for="editor" class="form-label">Content</label>
              <div class="card">
                <div class="card-body">
                  <p>
                    {!! $news->description !!}
                  </p>
                </div>
              </div>
            </div>

            <div class="text-center">
              <a href="{{ route('news.edit', $news->id) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i>
                Edit
              </a>
            </div>

        </div>
      </div>
    </div>
  </div>
@endsection