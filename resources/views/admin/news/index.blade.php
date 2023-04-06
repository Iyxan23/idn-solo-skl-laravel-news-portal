@extends('admin.parent')

@section('pagetitle')
    <div class="pagetitle">
      <h1>News</h1>
      <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item active">News</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
@endsection

@section('content')
    <div class="card">
    <div class="card-body">
        <div class="card-title">News</div>
        @if ($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-octagon me-1"></i>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endforeach
        @endif
        
        <form action="{{ route('news.search') }}" method="get">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search" aria-label="Search input" aria-describedby="button-search" name="keyword">
                <button class="btn btn-outline-secondary" type="submit" id="button-search">Search</button>
            </div>
        </form>

        <!-- Create Modal -->
        <a href="{{ route('news.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Add News
        </a>
        <!-- End Create Modal-->

        @isset($keyword)
        <p class="mt-3">Showing results for '{{ $keyword }}'</p>
        @endisset

        <!-- Table with stripped rows -->
        <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col">Image</th>
                <th scope="col">Date created</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($news as $row)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td><a href="{{ route('news.show', $row->id) }}">{{ $row->title }}</a></td>
                    <td>{{ $row->category->name }}</td>
                    <td>
                        <img src="{{ $row->image }}" alt="" class="w-25">
                    </td>
                    <td>{{ $row->date_created }}</td>
                    <td>
                        <a href="{{ route('news.show', $row->id) }}" class="btn btn-primary">
                            <i class="bi bi-eye-fill"></i>
                            See
                        </a>
                        
                        <a href="{{ route('news.edit', $row->id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        
                        <form action="{{ route('news.destroy', $row->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-octagon me-1"></i>
                        Data is empty
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div> 
                </td></tr>
            @endforelse
        </tbody>
        </table>
        <!-- End Table with stripped rows -->

        {{ $news->links('pagination::bootstrap-4') }}
    </div>
    </div>

    {{-- duar --}}
    

@endsection