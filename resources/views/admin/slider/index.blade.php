
@extends('admin.parent')

@section('pagetitle')
    <div class="pagetitle">
      <h1>Slider</h1>
      <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item active">Slider</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
@endsection

@section('content')
    <div class="card">
    <div class="card-body">
        <div class="card-title">Slider</div>
        @if ($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-octagon me-1"></i>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endforeach
        @endif

        <!-- Create Modal -->
        <a href="{{ route('slider.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Add Slider
        </a>
        <!-- End Create Modal-->

        <!-- Table with stripped rows -->
        <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Url</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sliders as $row)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td scope="row">
                        <img src="{{ $row->image }}" class="w-25" />
                    </td>
                    <td scope="row">
                        <a href="{{ $row->url }}">{{ $row->url }}</a>
                    </td>
                    <td scope="row">
                        <a href="{{ route('slider.show', $row->id) }}" class="btn btn-primary">
                            <i class="bi bi-eye-fill"></i>
                            See
                        </a>
                        
                        <a href="{{ route('slider.edit', $row->id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        
                        <form action="{{ route('slider.destroy', $row->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
        <!-- End Table with stripped rows -->

    </div>
    </div>

    {{-- duar --}}
    

@endsection