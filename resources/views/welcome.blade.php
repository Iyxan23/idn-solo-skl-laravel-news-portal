@extends('frontend.parent')
@section('content')
    <div class="container">
        <div class="mt-4 mb-3">
            <h3>Latest news</h3>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($news as $row)
            <div class="col">
                <div class="card">
                    <img src="{{ $row->image }}" class="card-img-top img-fluid" alt="{{ $row->title }}">
                    <div class="card-body">
                        <h3 class="card-title"><a href="{{ route('detail.news', $row->slug) }}">{{ $row->title }}</a></h3>
                        <div class="card-text text-truncate text-muted" style="max-height: 10rem;">
                            {!! $row->description !!}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection