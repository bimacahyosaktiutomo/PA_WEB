<?php
session_start();
require "../include/connect.php";

$navText = "Login";
if (isset($_SESSION['username'])) {
    $navText = $_SESSION['username'];
    // Mengamankan nilai $_SESSION['username']
    $safeUsername = mysqli_real_escape_string($conn, $_SESSION['username']);

    // Membuat query SQL dengan parameter aman
    $query = "SELECT uid FROM USER WHERE username='$safeUsername'";
    $result_id = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result_id);

    // Mengambil id dari hasil query
    $uid = $row['uid'];
}

if (isset($_SESSION['admin'])) {
    $navText = $_SESSION['admin'];
}

if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
    $result = mysqli_query($conn, "SELECT * FROM resep WHERE nama_resep LIKE '%$keyword%'");
} else {
    $result = mysqli_query($conn, "SELECT * FROM resep");
}

$resep = [];

while ($row = mysqli_fetch_assoc($result)) {
    $resep[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ifandi's Taste</title>
    <link rel="icon" href="../assets/webicon.png">
    <link rel="stylesheet" href="../styles/style.css">
    <script src="https://kit.fontawesome.com/9746b2e4c8.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body>
    <header id="home">
        <nav class="navbar shadow" id="navbar">
            <div>
                <a href="index.php"><img src="../assets/ifandi.png" alt="logo" class="webicon" id="webicon"></a>
            </div>
            <ul class="menu" id="menu">
                <li><a class="navitems" href="#home">Home</a></li>
                <li><a class="navitems" href="#news">Favorite</a></li>
                <li><a class="navitems" href="#me">About Us</a></li>
                <?php
                if (isset($_SESSION['username'])) {
                    echo "<li><a class='navitems' href='lihat_data.php?id=$uid'>Kelola Resep Anda</a></li>";
                }
                ?>
                <?php
                if (isset($_SESSION['admin'])) {
                    echo "<li><a class='navitems' href='dashboard.php'>Dashboard</a></li>";
                }
                ?>
                <div class="menumode">
                    <input type="checkbox" class="nightmode" id="nightmode" onclick="mode()">
                    <svg id="light" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                        <path d="M480-360q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35Zm0 80q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM80-440q-17 0-28.5-11.5T40-480q0-17 11.5-28.5T80-520h80q17 0 28.5 11.5T200-480q0 17-11.5 28.5T160-440H80Zm720 0q-17 0-28.5-11.5T760-480q0-17 11.5-28.5T800-520h80q17 0 28.5 11.5T920-480q0 17-11.5 28.5T880-440h-80ZM480-760q-17 0-28.5-11.5T440-800v-80q0-17 11.5-28.5T480-920q17 0 28.5 11.5T520-880v80q0 17-11.5 28.5T480-760Zm0 720q-17 0-28.5-11.5T440-80v-80q0-17 11.5-28.5T480-200q17 0 28.5 11.5T520-160v80q0 17-11.5 28.5T480-40ZM226-678l-43-42q-12-11-11.5-28t11.5-29q12-12 29-12t28 12l42 43q11 12 11 28t-11 28q-11 12-27.5 11.5T226-678Zm494 495-42-43q-11-12-11-28.5t11-27.5q11-12 27.5-11.5T734-282l43 42q12 11 11.5 28T777-183q-12 12-29 12t-28-12Zm-42-495q-12-11-11.5-27.5T678-734l42-43q11-12 28-11.5t29 11.5q12 12 12 29t-12 28l-43 42q-12 11-28 11t-28-11ZM183-183q-12-12-12-29t12-28l43-42q12-11 28.5-11t27.5 11q12 11 11.5 27.5T282-226l-42 43q-11 12-28 11.5T183-183Zm297-297Z" />
                    </svg>
                    <svg id="night" style="display: none;" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                        <path d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Zm0-80q88 0 158-48.5T740-375q-20 5-40 8t-40 3q-123 0-209.5-86.5T364-660q0-20 3-40t8-40q-78 32-126.5 102T200-480q0 116 82 198t198 82Zm-10-270Z" />
                    </svg>
                </div>
                <?php
                if (isset($_SESSION['username']) or isset($_SESSION['admin'])) {
                    echo "<h3>$navText</h3>";
                    echo "<a href='logout.php'><button type='button' class='btn-login'>Logout</button></a>";
                } else {
                    echo "<a href='login.php'><button type='button' class='btn-login'>$navText</button></a>";
                }
                ?>
            </ul>
            <div class="menu-toggle" id="menu-toggle">
                <svg id="menuBuka" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                    <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
                </svg>
                <svg id="menuTutup" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                    <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                </svg>
            </div>
        </nav>
        <section>
            <div class="isi1">
                <div class="konten-isi1">
                    <h1>Welcome To Ifandi's Taste</h1>
                    <p>
                        Inilah tempatnya segala resep masakan enak! Ifandi telah menyiapkan beragam hidangan seru bergaya rumahan, tepat sebagai masakan sehari-hari.
                    </p>
                    <ul class="text">
                        <li><a href="list_resep.php" id="download">Jelajahi Resep</a></li>
                    </ul>
                </div>
                <!-- <img src="../assets/Paimon.png" alt="paimon"> -->
            </div>
        </section>
        <section class="isi2" id="news">
            <h1 style="margin-bottom: 10vh; color: var(--text);">Menu Favorit</h1>
            <div class="carousel">
                <div>
                    <div class="content">
                        <h2>Sate</h2>
                        <span>Ayam</span>
                    </div>
                </div>
                <div>
                    <div class="content">
                        <h2>Pastel</h2>
                        <span></span>
                    </div>
                </div>
                <div>
                    <div class="content">
                        <h2>Terang Bulan</h2>
                        <span>Martabak Manis</span>
                    </div>
                </div>
                <div>
                    <div class="content">
                        <h2>Martabak</h2>
                        <span>Martabak Asin</span>
                    </div>
                </div>
            </div>
        </section>
        <section class="isi3">
            <div class="container">
                <div>
                    <h1>Neuvillette</h1>
                    <h4>VA : Kamiya Hiroshi</h4>
                    <p>Sang Iudex Fontaine bisa dibilang adalah seseorang yang "sulit didekati". Entah karena sifatnya, atau karena ada rahasia yang disembunyikannya.
                        "Melihat bagaimana kolom di balik layar tentang sang Archon Hydro kami di edisi sebelumnya mendapatkan julukan terhormat "jurnalisme tabloid" dari Monsieur Neuvillette.
                    </p>
                </div>
                <img src="../assets/italianfood.jpg" alt="">
            </div>
        </section>

        <!-- Ga wajib -->
        <!-- <section class="listkarakter">
            <div class="containerchr">
                <div class="searchbar">
                    <form action="index.php#listResep" method="post" style="display: flex;">
                        <input type="text" name="keyword" placeholder="Search">
                        <div class="searchbtn">
                            <i class="fa-solid fa-magnifying-glass"></i>                    
                        </div>
                    </form>
                </div>
                <?php if ($result->num_rows > 0) : ?>
                    <div class="container2">
                    <h1 id="listResep">List Resep</h1>
                    <div class="table">
                        <?php $i = 1;
                        foreach ($resep as $rsp) : ?>  
                        <a class="card shadow" href="resep.php?id=<?php echo $rsp['id_resep'] ?>">
                            <div>
                                <img src="../assets/uploadedImg/<?php echo $rsp['gambar']; ?>">
                                <div class="card-body">
                                    <h2 class="card-text"><?php echo $rsp['nama_resep']; ?></h2>                                  
                                    <p class="card-text"><?php echo $rsp['deskripsi']; ?></p><br>
                                </div>
                            </div>
                        </a>                                                    
                        <?php $i++;
                        endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <section class="pusatlayanan">
            <div class="kotakform shadow">
                <h1 style="text-align: center;">Pusat Layanan</h1>
                <form action="proses_layanan.php" method="post" enctype="multipart/form-data" id="support">
                    <div>
                        <label for="nama">Nama*</label>
                        <input type="text" class="form" id="nama" name="nama" required>
                    </div>
                    <div>
                        <label for="email">Email*</label>
                        <input type="email" class="form" id="email" name="email" required>
                    </div>
                    <div>
                        <label for="email">Telepon*</label>
                        <input type="tel" class="form" id="telp" name="telp" required>
                    </div>
                    <div>
                        <label for="layanan">Pilih Layanan*</label>
                        <select class="form" id="layanan" name="layanan">
                            <option value="Pertanyaan Umum">Pertanyaan Umum</option>
                            <option value="Pengaduan">Pengaduan</option>
                            <option value="Permintaan Informasi">Permintaan Informasi</option>
                            <option value="Pengembalian Akun">Pengembalian Akun</option>
                            <option value="Laporan Bug dan Glitch">Laporan Bug dan Glitch</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label for="pesan">Pesan*</label>
                        <input type="text" class="form" id="pesan" name="pesan" required>
                    </div>
                    <div class="divinput">
                        <label for="gambar" class="inputlabel">
                            <p>Gambar</p><br>
                            <img src="../assets/upload.png" alt="">
                        </label>
                        <input type="file" class="inputgambar" id="gambar" name="gambar">
                    </div>
                    <input class="btnkirim" type="submit" value="K I R I M  S E K A R A N G !">
                </form>
            </div>
        </section> -->
    </header>
    <footer>
        <p>Copyright © Aldi Solihin. All Rights Reserved.</p>
    </footer>
    <script>
        $('.jdl-berita').on('click', () => {
            $('.jdl-berita').css('color', '#FF4655')
        })
    </script>
    <script src="../scripts/javascript.js"></script>
</body>

</html>