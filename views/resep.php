<?php
session_start();
require "../include/connect.php";

$id = $_GET['id'];

$navText = "Login"; 
if (isset($_SESSION['username'])) {
    $navText = $_SESSION['username'];
    
    $safeUsername = mysqli_real_escape_string($conn, $_SESSION['username']);
    
    
    $query = "SELECT uid FROM USER WHERE username='$safeUsername'";
    $result_id = mysqli_query($conn, $query);    
    $row = mysqli_fetch_assoc($result_id);
    
    $uid = $row['uid'];    
}
if (isset($_SESSION['admin'])) {
    $navText = $_SESSION['admin'];
}

$result = mysqli_query($conn, "SELECT * FROM resep WHERE id_resep = '$id'");
$resep = [];
while ($row = mysqli_fetch_assoc($result)) {
    $resep[] = $row;
}


$query = "SELECT r.rating, r.komentar, u.username FROM rating r INNER JOIN resep on r.id_resep = resep.id_resep INNER JOIN user u ON r.uid = u.uid WHERE r.id_resep = '$id'";
$result = mysqli_query($conn, $query);

$komentar = [];

while ($row = mysqli_fetch_assoc($result)) {
    $komentar[] = $row;
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
    <link rel="stylesheet" href="../styles/rating.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/> 
</head>
<body>
    <header id="home">
        <nav class="navbar shadow" id="navbar">
            <div>
                <a href="../index.php"><img src="../assets/ifandi.png" alt="logo" class="webicon" id="webicon"></a>
            </div>
            <ul class="menu" id="menu">
                <li><a class="navitems" href="list_resep.php">Kembali</a></li>
                <div class="menumode">
                    <input type="checkbox" class="nightmode" id="nightmode" onclick="mode()"> 
                    <svg id="light" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-360q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35Zm0 80q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM80-440q-17 0-28.5-11.5T40-480q0-17 11.5-28.5T80-520h80q17 0 28.5 11.5T200-480q0 17-11.5 28.5T160-440H80Zm720 0q-17 0-28.5-11.5T760-480q0-17 11.5-28.5T800-520h80q17 0 28.5 11.5T920-480q0 17-11.5 28.5T880-440h-80ZM480-760q-17 0-28.5-11.5T440-800v-80q0-17 11.5-28.5T480-920q17 0 28.5 11.5T520-880v80q0 17-11.5 28.5T480-760Zm0 720q-17 0-28.5-11.5T440-80v-80q0-17 11.5-28.5T480-200q17 0 28.5 11.5T520-160v80q0 17-11.5 28.5T480-40ZM226-678l-43-42q-12-11-11.5-28t11.5-29q12-12 29-12t28 12l42 43q11 12 11 28t-11 28q-11 12-27.5 11.5T226-678Zm494 495-42-43q-11-12-11-28.5t11-27.5q11-12 27.5-11.5T734-282l43 42q12 11 11.5 28T777-183q-12 12-29 12t-28-12Zm-42-495q-12-11-11.5-27.5T678-734l42-43q11-12 28-11.5t29 11.5q12 12 12 29t-12 28l-43 42q-12 11-28 11t-28-11ZM183-183q-12-12-12-29t12-28l43-42q12-11 28.5-11t27.5 11q12 11 11.5 27.5T282-226l-42 43q-11 12-28 11.5T183-183Zm297-297Z"/></svg> 
                    <svg id="night" style="display: none;" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Zm0-80q88 0 158-48.5T740-375q-20 5-40 8t-40 3q-123 0-209.5-86.5T364-660q0-20 3-40t8-40q-78 32-126.5 102T200-480q0 116 82 198t198 82Zm-10-270Z"/></svg>
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
                <svg id="menuBuka" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg>
                <svg id="menuTutup" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
            </div>
        </nav>
        <section>
            <div class="isi1 isi-resep">
                <?php $i = 1; foreach ($resep as $rsp) :?>                                                        
                <img src="../assets/uploadedImg/<?php echo $rsp['gambar']; ?>" alt="" class="gambarResep">                                                                                          
                <div class="konten-isi1">               
                    <div class="card-text resep-inside">
                        <h2><?php echo $rsp['nama_resep']; ?> </h2>
                        <p><?php echo $rsp['deskripsi']; ?></p> 
                        <p><?php echo $rsp['instruksi']; ?></p> 
                        <p><?php echo $rsp['bahan']; ?></p> 
                    </div>
                <?php $i++; endforeach; ?>                                        
                </div>                
            </div>
        </section>
        <div class="header-komentar"><h1>Komentar</h1><p><?php echo count($komentar) ?></p></div>
        <section style="margin-bottom: 20px;">
            <div class="rating-container" name="rating">
                <div class="rating">
                    <form action="rating&comment.php" method="post">
                        <div class="star-rating">
                            <input type="radio" name="rate_<?php echo $rsp['id_resep']; ?>" id="rate-5_<?php echo $rsp['id_resep']; ?>" value="5">
                            <label for="rate-5_<?php echo $rsp['id_resep']; ?>" class="fas fa-star"></label>

                            <input type="radio" name="rate_<?php echo $rsp['id_resep']; ?>" id="rate-4_<?php echo $rsp['id_resep']; ?>" value="4">
                            <label for="rate-4_<?php echo $rsp['id_resep']; ?>" class="fas fa-star"></label>

                            <input type="radio" name="rate_<?php echo $rsp['id_resep']; ?>" id="rate-3_<?php echo $rsp['id_resep']; ?>" value="3">
                            <label for="rate-3_<?php echo $rsp['id_resep']; ?>" class="fas fa-star"></label>

                            <input type="radio" name="rate_<?php echo $rsp['id_resep']; ?>" id="rate-2_<?php echo $rsp['id_resep']; ?>" value="2">
                            <label for="rate-2_<?php echo $rsp['id_resep']; ?>" class="fas fa-star"></label>

                            <input type="radio" name="rate_<?php echo $rsp['id_resep']; ?>" id="rate-1_<?php echo $rsp['id_resep']; ?>" value="1">
                            <label for="rate-1_<?php echo $rsp['id_resep']; ?>" class="fas fa-star"></label>
                        </div>
                        <header></header>
                        <input type="hidden" name="uid" value="<?php echo $uid; ?>">
                        <input type="hidden" name="id_resep" value="<?php echo $rsp['id_resep']; ?>">
                        <div class="textarea">
                            <textarea name="comment_<?php echo $rsp['id_resep']; ?>" cols="80" placeholder="Berikan tanggapanmu.."></textarea>
                        </div>
                        <div class="btn-rating">
                            <button type="submit">KIRIM</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <section>
            <?php foreach ($komentar as $kmn) : ?>
                <div class="box-komentar">
                    <div class="review">
                        <div class="name-komentar"><?php echo $kmn['username']; ?></div>
                        <div class="text-komentar">
                            <div class="bintang-komentar">
                            <?php
                                $averageRating = $kmn['rating'];
                                for ($j = 0; $j < 5; $j++) {
                                $starClass = ($j < $averageRating) ? 'star' : 'empty-star';
                                echo '<span class="' . $starClass . '">&#9733</span>';
                                }
                            ?>
                            </div>
                            <p><?php echo $kmn['komentar']; ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
        </section>
    </header>
    <script src="../scripts/javascript.js"></script>
    <script src="../scripts/rating.js"></script>
</body>
</html>