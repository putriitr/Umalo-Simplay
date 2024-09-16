<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('dashboard') }}" class="logo">
                <img src="{{ asset('assets/images/logo.png') }}" alt="navbar brand" class="navbar-brand" width="120" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Beranda</p>
                    </a>
                </li>

                <!-- Member Management -->
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Kelola Member</h4>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#member-management">
                        <i class="fas fa-user"></i>
                        <p>Member</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="member-management">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('members.index') }}">
                                    <span class="sub-item">Semua Member</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Product Management -->
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Kelola Produk</h4>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#product-management">
                        <i class="fas fa-shopping-cart"></i>
                        <p>Produk</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="product-management">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.produk.index') }}">
                                    <span class="sub-item">Semua Produk</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.monitoring.index') }}">
                                    <span class="sub-item">Monitoring</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Content Management -->
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Kelola Konten</h4>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#content-management">
                        <i class="fas fa-info-circle"></i>
                        <p>Meta & Konten</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="content-management">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.meta.index') }}">
                                    <span class="sub-item">Meta</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.slider.index') }}">
                                    <span class="sub-item">Slider</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.activity.index') }}">
                                    <span class="sub-item">Aktivitas</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.brand.index') }}">
                                    <span class="sub-item">Merek</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Information & FAQ -->
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Informasi & Pertanyaan</h4>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#information-section">
                        <i class="fas fa-phone"></i>
                        <p>Informasi</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="information-section">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.location.index') }}">
                                    <span class="sub-item">Lokasi</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.faq.index') }}">
                                    <span class="sub-item">Pertanyaan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Master Data -->
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Data Master</h4>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#master-data">
                        <i class="fas fa-database"></i>
                        <p>Data Master</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="master-data">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('bidangperusahaan.index') }}">
                                    <span class="sub-item">Bidang Perusahaan</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.kategori.index') }}">
                                    <span class="sub-item">Kategori</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('parameter.index') }}">
                                    <span class="sub-item">Parameter</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.visitors') }}">
                                    <span class="sub-item">Pengunjung</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
