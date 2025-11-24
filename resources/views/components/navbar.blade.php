    <!-- Topbar Start -->
    <div class="container-fluid topbar px-0 px-lg-4 bg-light py-2 d-none d-lg-block">
        <div class="container">
            <div class="row gx-0 align-items-center">
                <div class="col-lg-8 text-center text-lg-start mb-lg-0">
                    <div class="d-flex flex-wrap">
                        <div class="border-end border-primary pe-3">
                            <a href="https://maps.app.goo.gl/zCU77hLXU1fJuNtN6" class="text-muted small"><i
                                    class="fas fa-map-marker-alt text-primary me-2"></i>Lokasi</a>
                        </div>
                        <div class="ps-3">
                            <a href="mailto:dkpp@blitarkab.go.id" class="text-muted small"><i
                                    class="fas fa-envelope text-primary me-2"></i>dkpp@blitarkab.go.id</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <div class="d-flex justify-content-end">
                        <div class="d-flex border-end border-primary pe-3">
                            <a class="btn p-0 text-primary me-3" href="https://www.facebook.com/dkppkabblitar"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn p-0 text-primary me-3" href="https://x.com/PertanianBlitar"><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn p-0 text-primary me-3" href="https://www.instagram.com/pertanian.blitar/"><i
                                    class="fab fa-instagram"></i></a>
                            <a class="btn p-0 text-primary me-0"
                                href="https://www.youtube.com/channel/UCEpu5jDC3rrOiqptgIkqXlg"><i
                                    class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar & Hero Start -->
    <div class="container-fluid nav-bar px-0 px-lg-4 py-lg-0">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a href="{{ url('/') }}" class="navbar-brand p-0">
                    <img src="{{ asset('img/logosipblitar.png') }}" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav mx-0 mx-lg-auto">
                        <a href="/" class="nav-item nav-link {{ Request::is('/') ? 'active' : '' }}">Beranda</a>
                        <a href="{{ url('datahargapublic') }}"
                            class="nav-item nav-link {{ Request::is('datahargapublic') ? 'active' : '' }}">Data
                            Harga</a>
                        <a href="{{ url('datapanganpublic') }}"
                            class="nav-item nav-link {{ Request::is('datapanganpublic') ? 'active' : '' }}">Data
                            Pangan</a>
                        <a href="{{ url('nbmpublic') }}"
                            class="nav-item nav-link {{ Request::is('nbmpublic') ? 'active' : '' }}">Data NBM</a>
                        <a href="{{ url('publikasipanganpublic') }}"
                            class="nav-item nav-link {{ Request::is('publikasipanganpublic') ? 'active' : '' }}">Publikasi
                            Pangan</a>
                        <a href="{{ url('tentang') }}"
                            class="nav-item nav-link {{ Request::is('tentang') ? 'active' : '' }}">Tentang</a>



                    </div>
                </div>
                <div class="d-none d-xl-flex flex-shrink-0 ps-4">
                    <a href="tel:+62 8570 7069 008"
                        class="btn btn-light btn-lg-square rounded-circle position-relative wow tada"
                        data-wow-delay=".9s">
                        <i class="fa fa-phone-alt fa-2x"></i>
                        <div class="position-absolute" style="top: 7px; right: 12px;">
                            <span><i class="fa fa-comment-dots text-secondary"></i></span>
                        </div>
                    </a>
                    <div class="d-flex flex-column ms-3">
                        <span>Hubungi kami</span>
                        <a href="tel:+62 8570 7069 008"><span class="text-dark">Free: +62 8570 7069 008</span></a>
                    </div>
                    <div class="d-flex py-2  justify-content-center ms-4 ">
                        <a href={{ url('index/login') }} type="button" class="btn btn-primary"
                            data-mdb-ripple-init>Login</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar & Hero End -->
