<!-- Footer Start -->
<div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-xl-9">
                <div class="mb-5">
                    <div class="row g-4">
                        <div class="col-md-6 col-lg-6 col-xl-5">
                            <div class="footer-item">
                                <a href="{{ url('/') }}" class="p-2">
                                    <h3 class="text-white"><img src="{{ asset('img/logosipblitar.png') }}"
                                            alt="Logo"></i>
                                    </h3>
                                    <!-- <img src="img/logosipblitar.png" alt="Logo"> -->
                                </a>
                                <p class="text-white mb-4">
                                    Sistem Informasi Pangan Kabupaten Blitar (SIP) adalah sebuah platform digital yang
                                    dirancang untuk menyediakan informasi terkait ketersediaan, distribusi, dan harga
                                    bahan pangan di wilayah Kabupaten Blitar.</p>
                                <div class="footer-btn d-flex">
                                    <a class="btn btn-md-square rounded-circle me-3"
                                        href="https://www.facebook.com/dkppkabblitar"><i
                                            class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-md-square rounded-circle me-3"
                                        href="https://www.youtube.com/channel/UCEpu5jDC3rrOiqptgIkqXlg"><i
                                            class="fab fa-youtube"></i></a>
                                    <a class="btn btn-md-square rounded-circle me-3"
                                        href="https://www.instagram.com/pertanian.blitar/"><i
                                            class="fab fa-instagram"></i></a>
                                    <a class="btn btn-md-square rounded-circle me-0"
                                        href="https://x.com/PertanianBlitar"><i class="fab fa-twitter"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-4">
                            <div class="footer-item">
                                <h4 class="text-white mb-4">Link Yang DIgunakan</h4>
                                <a href={{ url('/') }}><i class="fas fa-angle-right me-2"></i> Beranda</a>
                                <a href={{ url('datahargapublic') }}><i class="fas fa-angle-right me-2"></i> Data
                                    Harga</a>
                                <a href={{ url('datapanganpublic') }}><i class="fas fa-angle-right me-2"></i> Data
                                    Pangan</a>
                                <a href={{ url('nbmpublic') }}><i class="fas fa-angle-right me-2"></i> Data NBM</a>
                                <a href={{ url('publikasipanganpublic') }}><i class="fas fa-angle-right me-2"></i>
                                    Publikasi Pangan</a>
                                <a href={{ url('tentang') }}><i class="fas fa-angle-right me-2"></i> Tentang</a>
                            </div>
                        </div>
                        {{-- <div class="col-md-6 col-lg-6 col-xl-4">
                            <div class="footer-item">
                                <h4 class="mb-4 text-white">Instagram</h4>
                                <div class="row g-3">
                                    <div class="col-4">
                                        <div class="footer-instagram rounded">
                                            <img src="img/instagram-footer-1.jpg" class="img-fluid w-100"
                                                alt="">
                                            <div class="footer-search-icon">
                                                <a href="img/instagram-footer-1.jpg" data-lightbox="footerInstagram-1"
                                                    class="my-auto"><i class="fas fa-link text-white"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="footer-instagram rounded">
                                            <img src="img/instagram-footer-2.jpg" class="img-fluid w-100"
                                                alt="">
                                            <div class="footer-search-icon">
                                                <a href="img/instagram-footer-2.jpg" data-lightbox="footerInstagram-2"
                                                    class="my-auto"><i class="fas fa-link text-white"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="footer-instagram rounded">
                                            <img src="img/instagram-footer-3.jpg" class="img-fluid w-100"
                                                alt="">
                                            <div class="footer-search-icon">
                                                <a href="img/instagram-footer-3.jpg" data-lightbox="footerInstagram-3"
                                                    class="my-auto"><i class="fas fa-link text-white"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="footer-instagram rounded">
                                            <img src="img/instagram-footer-4.jpg" class="img-fluid w-100"
                                                alt="">
                                            <div class="footer-search-icon">
                                                <a href="img/instagram-footer-4.jpg" data-lightbox="footerInstagram-4"
                                                    class="my-auto"><i class="fas fa-link text-white"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="footer-instagram rounded">
                                            <img src="img/instagram-footer-5.jpg" class="img-fluid w-100"
                                                alt="">
                                            <div class="footer-search-icon">
                                                <a href="img/instagram-footer-5.jpg" data-lightbox="footerInstagram-5"
                                                    class="my-auto"><i class="fas fa-link text-white"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="footer-instagram rounded">
                                            <img src="img/instagram-footer-6.jpg" class="img-fluid w-100"
                                                alt="">
                                            <div class="footer-search-icon">
                                                <a href="img/instagram-footer-6.jpg" data-lightbox="footerInstagram-6"
                                                    class="my-auto"><i class="fas fa-link text-white"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="pt-5" style="border-top: 1px solid rgba(255, 255, 255, 0.08);">
                    <div class="row g-0">
                        <div class="col-12">
                            <div class="row g-4">
                                <div class="col-lg-6 col-xl-4">
                                    <div class="d-flex">
                                        <div class="btn-xl-square bg-primary text-white rounded p-4 me-4">
                                            <i class="fas fa-map-marker-alt fa-2x"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-white">Alamat</h4>
                                            <p class="mb-0">Jl. Ahmad Yani No.25 Kota Blitar</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-4">
                                    <div class="d-flex">
                                        <div class="btn-xl-square bg-primary text-white rounded p-4 me-4">
                                            <i class="fas fa-envelope fa-2x"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-white">Email</h4>
                                            <p class="mb-0">dkpp@blitarkab.go.id</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-4">
                                    <div class="d-flex">
                                        <div class="btn-xl-square bg-primary text-white rounded p-4 me-4">
                                            <i class="fa fa-phone-alt fa-2x"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-white">Telephone</h4>
                                            <p class="mb-0">(+62) 8570 7069 008 </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3">
                <div class="footer-item">
                    <h4 class="text-white mb-4">Berita Baru</h4>
                    <p class="text-white mb-3">Kabupaten Blitar mengumumkan peningkatan fitur untuk memudahkan
                        masyarakat dalam memantau harga bahan pangan secara real-time.</p>
                    {{-- <div class="position-relative rounded-pill mb-4">
                        <input class="form-control rounded-pill w-100 py-3 ps-4 pe-5" type="text"
                            placeholder="Email">
                        <button type="button"
                            class="btn btn-primary rounded-pill position-absolute top-0 end-0 py-2 mt-2 me-2">SignUp</button>
                    </div> --}}
                    <div class="d-flex flex-shrink-0">
                        <div class="footer-btn">
                            <a href="tel:+62 8570 7069 008"
                                class="btn btn-lg-square rounded-circle position-relative wow tada"
                                data-wow-delay=".9s">
                                <i class="fa fa-phone-alt fa-2x"></i>
                                <div class="position-absolute" style="top: 2px; right: 12px;">
                                    <span><i class="fa fa-comment-dots text-secondary"></i></span>
                                </div>
                            </a>
                        </div>
                        <div class="d-flex flex-column ms-3 flex-shrink-0">
                            <span>Hubungi Kami</span>
                            <a href="tel:+62 8570 7069 008"><span class="text-white">Free: +62 8570 7069 008</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Copyright Start -->
<div class="container-fluid copyright py-4">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-md-6 text-center text-md-end mb-md-0">
                <span class="text-body"><a href="/" class="border-bottom text-white"><i
                            class="fas fa-copyright text-light me-2"></i>DKPPKabupatenBlitar2024</a></span>
            </div>
            <div class="col-md-6 text-center text-md-start text-body">
                <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                {{-- Designed By <a class="border-bottom text-white" href="https://htmlcodex.com">HTML Codex</a> --}}
                {{-- Distributed By <a class="border-bottom text-white" href="https://themewagon.com">ThemeWagon</a> --}}
            </div>
        </div>
    </div>
</div>
<!-- Copyright End -->
