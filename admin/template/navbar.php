<div class="layout-page">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: white;">
        <div class="container-fluid">
            <a class="navbar-brand text-dark" href="?page=dashboard">TOKO SUKSES BERSAMA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= $_GET['page'] == '' || $_GET['page'] == 'dashboard' ? 'active text-dark ' : 'text-dark' ?>" aria-current="page" href="?page=dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $_GET['page'] == 'kategori' ? 'active text-dark ' : 'text-dark' ?>" href="?page=kategori">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $_GET['page'] == 'produk' ? 'active text-dark ' : 'text-dark' ?>" href="?page=produk">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $_GET['page'] == 'supplier' ? 'active text-dark ' : 'text-dark' ?>" href="?page=supplier">Pemasok</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $_GET['page'] == 'pesanan' ? 'active text-dark ' : 'text-dark' ?>" href="?page=pesanan">Pesanan</a>
                    </li>
                </ul>
                <span class="navbar-text">
                <a class="text-dark" href="logout.php">Log Out</a>
                </span>
            </div>
        </div>
    </nav>
    <div class="content-wrapper">