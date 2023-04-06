@extends('admin.parent')

@section('pagetitle')
    <div class="pagetitle">
      <h1>Edit News</h1>
      <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('news.index') }}">News</a></li>
            <li class="breadcrumb-item"><a href="{{ route('news.show', $news->id) }}">{{ $news->title }}</a></li>
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
          <div class="card-title">Edit {{ $news->title }}</div>

          @if ($errors->any())
              @foreach($errors->all() as $error)
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <i class="bi bi-exclamation-octagon me-1"></i>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              @endforeach
          @endif

          <form class="row g-3" action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="col-md-12">
              <label for="titleInput" class="form-label">Title</label>
              <input type="text" class="form-control" id="titleInput" name="title" value="{{ $news->title }}" required>
            </div>
            <div class="col-md-12">
              <label for="imageInput" class="form-label">Image</label>
              <input type="file" class="form-control" id="imageInput" name="image" value="{{ $news->image }}">
            </div>
            <div class="col-md-4">
              <label for="categoryInput" class="form-label">Category</label>
              <select id="categoryInput" class="form-select" name="category_id">

                @foreach ($categories as $row)
                  <option @if($row->id === $news->category->id) selected @endif value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-12">
              <label for="editor" class="form-label">Content</label>
              <textarea name="description" id="editor">{{ $news->description }}</textarea>
              <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
              <script>
                  ClassicEditor
                      .create(document.querySelector('#editor'))
                      .catch(error => {
                          console.error(error);
                      });
              </script>
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