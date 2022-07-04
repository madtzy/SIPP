<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div>
            <li class="backgorund_logo">
                <a href="#" class="nav__logo">
                    <span class="text-dark fw-bold fs-5"><img src="/img/logo.jpg" alt="" class="logo">ADMIN | SIPP</span>
                </a>
            </li>
            <div class="nav__list">
                <a href="/admin/dashboard" class="nav__link text-white {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
                    <span class="nav__name fs-6"><i class="bx bx-sm bxs-dashboard me-3"></i>Dashboard</span>
                </a>
                <a href="/admin/produks" class="nav__link text-white {{ Request::is('admin/produks*') ? 'active' : '' }}">
                    <span class="nav__name fs-6"><i class='bx bx-sm bxs-bowl-rice me-3'></i>Data Produk</span>
                </a>
                <a href="/admin/stoks" class="nav__link text-white {{ Request::is('admin/stoks*') ? 'active' : '' }}">
                    <span class="nav__name fs-6"><i class='bx bx-sm bxs-customize me-3'></i>Data Stok</span>
                </a>
                <a href="/admin/buyers" class="nav__link text-white {{ Request::is('admin/buyers*') ? 'active' : '' }}">
                    <span class="nav__name fs-6"><i class='bx bx-sm bx-money-withdraw me-3'></i>Data Pemesan</span>
                </a>
                <a class="nav__link text-white dropdown-bs-toggle {{ Request::is('admin/prediksi*') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#collapse"
                    aria-expanded="false" aria-controls="collapse">
                    <span class="nav__name fs-6"><i class='bx bx-sm bxs-timer me-3'></i>Prediksi</span>
                </a>
                <div id="collapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-dropdown py-2">
                        <a class="dropdown-item text-white ms-5" href="/admin/prediksi/harian">Prediksi Harian</a>
                        <hr class="dropdown-divider">
                        <a class="dropdown-item text-white ms-5" href="/admin/prediksi/7hari">Prediksi 7 Hari</a>
                        <hr class="dropdown-divider">
                        <a class="dropdown-item text-white ms-5" href="/admin/prediksi/14hari">Prediksi 14 Hari</a>
                        <hr class="dropdown-divider">
                        <a class="dropdown-item text-white ms-5" href="/admin/prediksi/bulanan"></i>Bulanan</a>
                    </div>
                </div>
                <a href="/admin/kasir" class="nav__link text-white {{ Request::is('admin/kasir*') ? 'active' : '' }}">
                    <span class="nav__name fs-6"><i class='bx bx-sm bxs-user-plus me-3'></i></i>Data Kasir</span>
                </a>
            </div>
        </div>
    </nav>
</div>
