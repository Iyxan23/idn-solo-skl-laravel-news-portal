@extends('admin.parent')

@section('pagetitle')
<div class="pagetitle">
    <h1>Category</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item active">Category</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Category</h5>
        @if ($errors->any())
        @foreach($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-octagon me-1"></i>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endforeach
        @endif
         
        <form action="{{ route('category.search') }}" method="get">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search" aria-label="Search input" aria-describedby="button-search" name="keyword">
                <button class="btn btn-outline-secondary" type="submit" id="button-search">Search</button>
            </div>
        </form>
        
        <!-- Create Modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
            <i class="bi bi-plus-lg"></i> Add Category
        </button>
        @include('admin.category.create-modal')
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
                    <th scope="col">Slug</th>
                    <th scope="col">Image</th>
                    <th scope="col">Date Created</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $row)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->slug }}</td>
                    <td>
                        <img class="w-25" src="{{ $row->image }}" alt="Category icon">
                    </td>
                    <td>
                        {{ $row->created_at }}
                    </td>
                    <td>
                        <!-- Edit Modal -->
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{ $row->id }}">
                            <i class="bi bi-pen"></i> Edit Category
                        </button>
                        @include('admin.category.edit-modal')
                        <!-- End Edit Modal-->
                        
                        <form action="{{ route('category.destroy', $row->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">
                                <i class="bi bi-trash"></i>Delete
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
        
        {{ $categories->links('pagination::bootstrap-5') }}
    </div>
</div>

{{-- duar --}}


@endsection