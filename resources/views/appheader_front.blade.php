<!-- Header -->
<header class="header header-three">
    <div class="container">
        <nav class="navbar navbar-expand-lg header-nav">
            <div class="navbar-header">
                <a id="mobile_btn" href="javascript:void(0);">
                    <span class="bar-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </a>
                <a href="/" class="navbar-brand logo">
                    <img src="{{ asset('assets/img/logo.png') }}" class="img-fluid" alt="Logo">
                </a>
                <a href="/" class="navbar-brand logo-small">
                    <img src="{{ asset('assets/img/logo.png') }}" class="img-fluid" alt="Logo">
                </a>
            </div>
            <div class="main-menu-wrapper">
                <div class="menu-header">
                    <a href="/" class="menu-logo">
                        <img src="assets/img/logo.png" class="img-fluid" alt="Logo">
                    </a>
                    <a id="menu_close" class="menu-close" href="javascript:void(0);"> <i class="fas fa-times"></i></a>
                </div>
                <ul class="navbar-nav main-nav my-2 my-lg-0">
                    <li class="">
                        <a href="/">Home </a>

                    </li>
                    <li><a href="{{ url('/bmd_potensial/list_depan') }}">Aset Potensial </a></li>

                    <li class="has-submenu">
                        <a href="">Kategori <i class="fas fa-chevron-down"></i></a>
                        <ul class="submenu">
                            <li><a href="#">Tanah Kosong</a></li>
                            <li><a href="#">Perniagaan</a></li>
                            <li><a href="#">Sarana Olahraga</a></li>
                            <li><a href="#">Sewa Ruangan</a></li>
                            <li><a href="#">Penginapan</a></li>
                            <li><a href="#">Perkantoran</a></li>
                            <li><a href="#">Open Space</a></li>
                            <li><a href="#">Outdoor Space</a></li>

                        </ul>
                    </li>

                    <li><a href="">Artikel</a></li>
                    <li><a href="">Tentang</a></li>
                    @auth
                        <li><a href="{{ url('/bmd_potensial') }}">Dashboard</a></li>
                    @endauth


                </ul>
            </div>
            <div class="d-flex align-items-center block-e">
                @if (Auth::check())
                    <div class="cta-btn">
                        <a href="/auth/logout" class="btn">Sign Out</a>
                    </div>
                @else
                    <div class="cta-btn">
                        <a href="/index/login" class="btn">Sign In</a>
                    </div>
                @endif
            </div>
        </nav>
    </div>
</header>
<!-- /Header -->
