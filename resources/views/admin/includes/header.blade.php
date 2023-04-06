<header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
    <a href="index.html" class="logo d-flex align-items-center">
    <img src="{{ url('admin/assets/img/logo.png') }}" alt="">
    <span class="d-none d-lg-block">News Portal</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->

<div class="search-bar">
    <form class="search-form d-flex align-items-center" method="POST" action="#">
    <input type="text" name="query" placeholder="Search" title="Enter search keyword">
    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
    </form>
</div><!-- End Search Bar -->

<nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

    <li class="nav-item d-block d-lg-none">
        <a class="nav-link nav-icon search-bar-toggle " href="#">
        <i class="bi bi-search"></i>
        </a>
    </li><!-- End Search Icon-->

    <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        {{-- <img src="{{ url('admin/assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle"> --}}
        <img src="https://media.licdn.com/dms/image/D5603AQELpwmj7vkQEA/profile-displayphoto-shrink_800_800/0/1675300672336?e=1683763200&v=beta&t=RewSkYQkcEevyo6K9qh9ibzHUhgryMAdRryp9jpoHSE" alt="profile" class="rounded-circle">
        <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
        </a><!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">
            <h6>{{ Auth::user()->name }}</h6>
            <span>User</span>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>

        <li>
            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
            <i class="bi bi-person"></i>
            <span>My Profile</span>
            </a>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>

        <li>
            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
            <i class="bi bi-gear"></i>
            <span>Account Settings</span>
            </a>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>

        <li>
            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
            <i class="bi bi-question-circle"></i>
            <span>Need Help?</span>
            </a>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>

        <li>
            <a href="{{ route('logout') }}" class="dropdown-item d-flex align-items-center"
                onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                <i class="bi bi-box-arrow-right"></i>
                <form id="frm-logout" action="{{ route('logout') }}" method="POST"
                    style="display: none;">
                    {{ csrf_field() }}
                </form>
                <span>Sign Out</span>
            </a>
        </li>

        </ul><!-- End Profile Dropdown Items -->
    </li><!-- End Profile Nav -->

    </ul>
</nav><!-- End Icons Navigation -->

</header>