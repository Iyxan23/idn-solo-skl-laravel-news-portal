<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
        
        <a href="/" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1>IDNesiaNews</h1>
        </a>
        
        <nav id="navbar" class="navbar">
            <ul>
                @foreach ($nav_category as $nav)
                    <li><a href="{{ route('detail.category', $nav->slug) }}">{{ $nav->name }}</a></li>
                @endforeach
            </ul>
        </nav><!-- .navbar -->
        
        <div class="position-relative">
            <a href="#" class="mx-2"><span class="bi-facebook"></span></a>
            <a href="#" class="mx-2"><span class="bi-twitter"></span></a>
            <a href="#" class="mx-2"><span class="bi-instagram"></span></a>
            
            <a href="#" class="mx-2 js-search-open"><span class="bi-search"></span></a>
            <i class="bi bi-list mobile-nav-toggle"></i>
            
            <!-- ======= Search Form ======= -->
            <div class="search-form-wrap js-search-form-wrap">
                <form action="{{ route('search.end-news') }}" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search" aria-label="Search input" aria-describedby="button-search" name="keyword">
                        <button class="btn btn-outline-secondary" type="submit" id="button-search">Search</button>
                    </div>
                </form>
                {{-- <form action="search-result.html" class="search-form">
                    <span class="icon bi-search"></span>
                    <input type="text" placeholder="Search" class="form-control">
                    <button class="btn js-search-close"><span class="bi-x"></span></button>
                </form> --}}
            </div><!-- End Search Form -->
            
        </div>
        
    </div>
    
</header>