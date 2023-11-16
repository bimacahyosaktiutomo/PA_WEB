<?php
session_start();
require "../include/connect.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit;
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ifandi's Taste Admin</title>
    <link rel="icon" href="../assets/webicon.png">
    <link rel="stylesheet" href="../styles/dashboard.css">
    <script src="https://kit.fontawesome.com/9746b2e4c8.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <div class="logosec">
            <a href="dashboard.php"><img src="../assets/ifandi.png" alt="logo" class="webicon" id="webicon" height="70vh"></a>
        </div>
        <div class="searchbar">
            <form action="" method="post" style="display: flex;">
                <input type="text" name="keyword" placeholder="Search">
                <div class="searchbtn">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
            </form>
        </div>
        <div>
            <i class="fa-solid fa-bars fa-lg icn menuicn" id="menuicn"></i>
        </div>
    </header>

    <div class="main-container">
        <div class="navcontainer">
            <nav class="nav">
                <div class="nav-upper-options">
                    <div class="nav-option option1">
                        <i class="fa-solid fa-table-columns"></i>
                        <h3> Dashboard</h3>
                    </div>
                    <div class="nav-option logout">
                        <a href="../index.php">
                            <i class="fa-solid fa-arrow-left"></i>
                            <h3>Kembali</h3>
                        </a>
                    </div>
                    <div class="nav-option logout">
                        <a href="logout.php">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <h3>Logout</h3>
                        </a>
                    </div>

                </div>
            </nav>
        </div>
        <div class="main">
            <div class="searchbar2">
                <input type="text" name="" id="" placeholder="Search">
                <div class="searchbtn">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
            </div>
            <div class="report-container">
                <div class="report-header">
                    <h1 class="recent-Articles">Recent Articles</h1>
                    <section id="sec-time">
                        <div id="waktu">
                            <p><span id="hari"></span> <span id="tanggal-jam"></span> <span id="timezone"></span></p>
                            <script>
                                function refreshHari() {
                                    const hari_tag = document.getElementById("hari");
                                    const date = new Date();
                                    const hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                    const day_name = hari[date.getDay()];

                                    const formattedString = `${day_name}`;
                                    hari_tag.textContent = formattedString;
                                }
                                refreshHari();
                                setInterval(refreshHari, 1000);

                                function refreshTanggal() {
                                    const tanggal_tag = document.getElementById("tanggal-jam");
                                    const date = new Date();
                                    const day = date.getDate();
                                    const month = date.getMonth() + 1;
                                    const year = date.getFullYear();
                                    const hours = date.getHours();
                                    const minutes = date.getMinutes();
                                    const seconds = date.getSeconds();

                                    const formattedString = `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;
                                    tanggal_tag.textContent = formattedString;
                                }
                                refreshTanggal();
                                setInterval(refreshTanggal, 1000);

                                function refreshHariZona() {
                                    const timezone_tag = document.getElementById("timezone");
                                    const date = new Date();
                                    const timeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
                                    const formattedString = `${timeZone}`;
                                    timezone_tag.textContent = formattedString;
                                }
                                refreshHariZona();
                                setInterval(refreshHariZona, 1000);
                            </script>
                        </div>

                    </section>
                    <a href="tambah_data.php?id=1"><button class="tambah">Tambah Data +</button></a>
                </div>

                <div class="report-body">
                    <div class="items">
                        <table>
                            <thead>
                                <tr>
                                    <th>
                                        <h3 class="t-op">UID</h3>
                                    </th>
                                    <th>
                                        <h3 class="t-op">ID Resep</h3>
                                    </th>
                                    <th>
                                        <h3 class="t-op">Nama Resep</h3>
                                    </th>
                                    <th>
                                        <h3 class="t-op">Deskripsi</h3>
                                    </th>
                                    <th>
                                        <h3 class="t-op">Bahan</h3>
                                    </th>
                                    <th>
                                        <h3 class="t-op">Instruksi</h3>
                                    </th>
                                    <th>
                                        <h3 class="t-op">Gambar</h3>
                                    </th>
                                    <th>
                                        <h3 class="t-op">Aksi</h3>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($resep as $rsp) : ?>
                                    <tr>
                                        <td><?php echo $rsp['uid']; ?></td>
                                        <td><?php echo $rsp['id_resep']; ?></td>
                                        <td><?php echo $rsp['nama_resep']; ?> </td>
                                        <td><?php echo $rsp['deskripsi']; ?></td>
                                        <td><?php echo $rsp['bahan']; ?></td>
                                        <td><?php echo $rsp['instruksi']; ?></td>
                                        <td><img src="../assets/uploadedImg/<?php echo $rsp['gambar']; ?>" alt="" height="100px"></td>
                                        <td class="action">
                                            <a href="edit_data.php?id=<?php echo $rsp['id_resep'] ?>"><button class="edit-btn"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" fill="white">
                                                        <path d="M200-200h56l345-345-56-56-345 345v56Zm572-403L602-771l56-56q23-23 56.5-23t56.5 23l56 56q23 23 24 55.5T829-660l-57 57Zm-58 59L290-120H120v-170l424-424 170 170Zm-141-29-28-28 56 56-28-28Z" />
                                                    </svg></button></a>
                                            <br>
                                            <a href="hapus_data.php?id=<?php echo $rsp['id_resep'] ?>"><button class="delete-btn" onclick="confirm('Yakin ingin menghapus <?php echo $rsp['nama_resep'] ?>?')"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" fill="white">
                                                        <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                                                    </svg></button></a>
                                        </td>
                                    </tr>
                                <?php $i++;
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../scripts/dashboard.js"></script>
</body>

</html>