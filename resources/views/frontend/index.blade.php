@extends('frontend.parent')

@section('content') 
    <div class="col-12 mb-5">
        <div class="swiper sliderFeaturedPosts">
            <div class="swiper-wrapper">

                @foreach ($slider as $row)
                <div class="swiper-slide">
                    <a href="{{ $row->url }}" class="img-bg d-flex align-items-end" style="background-image: url('{{ $row->image }}');">
                        <div class="img-bg-inner">
                            <h2>{{ $row->title }}</h2>
                            <p>{{ $row->description }}</p>
                        </div>
                    </a>
                </div>
                @endforeach

            </div>
            <div class="custom-swiper-button-next">
                <span class="bi-chevron-right"></span>
            </div>
            <div class="custom-swiper-button-prev">
                <span class="bi-chevron-left"></span>
            </div>
            
            <div class="swiper-pagination"></div>
        </div>
    </div>
            
    <h3 class="category-title">Latest News</h3>

    @forelse ($news as $row)
    <div class="d-md-flex post-entry-2 small-img">
        <a href="{{ route('detail.news', $row->slug) }}" class="me-4 thumbnail">
            <img src="{{ $row->image }}" alt="" class="img-fluid">
        </a>
        <div>
            <div class="post-meta"><span class="date">{{ $row->category->name }}</span> <span class="mx-1">•</span> <span>{{ $row->created_at }}</span></div>
            <h3><a href="{{ route('detail.news', $row->slug) }}">{{ $row->title }}</a></h3>
            <p>{!! Str::words($row->description, '60') !!}</p>
            <div class="d-flex align-items-center author">
                <div class="photo"><img src="{{ url('frontend/assets/img/person-4.jpg') }}" alt="" class="img-fluid"></div>
                <div class="name">
                    <h3 class="m-0 p-0">Nur Ihsan Al Ghifari</h3>
                </div>
            </div>
        </div>
    </div>
    @empty
        No news published
    @endforelse

    <!-- Paging -->
    <div class="text-start py-4">
        <div class="custom-pagination">
            <a href="#" class="prev">Prevous</a>
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#" class="next">Next</a>
        </div>
    </div><!-- End Paging -->          
@endsection