<nav class="navbar navbar-example navbar-expand-lg " style="background-color:white;">
    <div class="container">
        <a class="navbar-brand fw-bold text-black" href="index.php">Toko Sukses Bersama</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-3">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-ex-3">
            <div class="navbar-nav me-auto">
                <span class="nav-item nav-link" href="javascript:void(0)"></span>
            </div>

            <?php if ($_SESSION['level'] == '2') : ?>
                <a class="nav-item nav-link text-black" href="?page=keranjang">Keranjang</a>
                <a class="nav-item nav-link text-black" href="?page=pesanan">Pesanan</a>
                <div class="dropdown">
                    <button class="btn btn-success dropdown-togglen text-dark" style="background-color:white;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $_SESSION['nama']; ?>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </div>
            <?php else : ?>
                <a class="btn text-dark" style="background-color:white;" href="login.php">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>