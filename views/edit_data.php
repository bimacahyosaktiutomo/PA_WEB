<?php
    session_start();
    require "../include/connect.php";
    
    if(isset($_SESSION['admin']) or isset($_SESSION['username'])){
    
    } else {
        header("Location: login.php");
        exit;
    }
    
    $id = $_GET['id'];
    if(!isset($id)){
        header("Location: ../index.php");
        exit;
    }

    $get = mysqli_query($conn, "SELECT * FROM resep WHERE id_resep = $id");
    $resep = [];

    while ($row = mysqli_fetch_assoc($get)) {
        $resep[] = $row;
    }
    $resep = $resep[0];

    if (isset($_POST['ubah'])) {
        $nama = $_POST['nama'];
        $deskripsi = $_POST['deskripsi'];
        $instruksi = $_POST['instruksi'];
        $bahan = $_POST['bahan'];
        
        $gambar_lama = mysqli_query($conn, "SELECT gambar FROM resep where id_resep = $id"); 
        $row = mysqli_fetch_assoc($gambar_lama);
        $nama_file = $row['gambar'];
        $lokasi_file = '../assets/uploadedImg/' . $nama_file; 

        // date dan timezone 
        date_default_timezone_set('Asia/Makassar');
        $tanggal = date("Y-m-d h-i-s");

        if ($_FILES['gambar']['error'] == UPLOAD_ERR_OK) {
            $gambar = $_FILES['gambar']['name'];
            $temp_file = $_FILES['gambar']['tmp_name'];

            $allowed_extensions = array("jpg", "jpeg", "png", "gif");
            $file_extension = pathinfo($gambar, PATHINFO_EXTENSION);

            if($nama_file != "NoImage.png"){
                if (file_exists($lokasi_file)) {
                    unlink($lokasi_file);
                } 
            }

            if (in_array($file_extension, $allowed_extensions)) {
                $x = explode('.',$gambar);
                $ekstensi = strtolower(end($x));
                $gambar_baru = "$tanggal.$nama.$ekstensi";
                move_uploaded_file($temp_file, "../assets/uploadedImg/".$gambar_baru);
                $result = mysqli_query($conn, "UPDATE resep SET nama_resep='$nama', deskripsi='$deskripsi', instruksi='$instruksi', bahan='$bahan', gambar='$gambar_baru' WHERE id_resep = $id");
            } else {
                $result = mysqli_query($conn, "UPDATE resep SET nama_resep='$nama', deskripsi='$deskripsi', instruksi='$instruksi', bahan='$bahan' WHERE id_resep = $id");
            }
        } else {
            $result = mysqli_query($conn, "UPDATE resep SET nama_resep='$nama', deskripsi='$deskripsi', instruksi='$instruksi', bahan='$bahan' WHERE id_resep = $id");
        }

        if ($result) {
            echo "
            <script>
                alert('Data berhasil diubah !');
                document.location.href = 'dashboard.php';
            </script>";
        } else {
            echo "
            <script>
                alert('Data gagal diubah !');
                document.location.href = 'dashboard.php';
            </script>";
        }
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" href="../styles/dashboard.css">
</head>
<body>
    <section class="add-data">
        <div class="add-form-container">
            <h1>Edit Data</h1><hr><br>
            <form action="" method="post" enctype="multipart/form-data">
                <label for="nama">Nama Resep*</label>
                <input type="text" name="nama" class="textfield" value="<?php echo $resep['nama_resep'] ?>" required>                                
                <label for="deskripsi">Deskripsi*</label>
                <input type="text" name="deskripsi" class="textfield" value="<?php echo $resep['deskripsi'] ?>" required>
                <label for="bahan">Bahan*</label>
                <textarea type="text" name="bahan" class="textfield" required><?php echo $resep['bahan'] ?></textarea>
                <label for="instruksi">Instruksi*</label>
                <textarea type="text" name="instruksi" class="textfield" required><?php echo $resep['instruksi'] ?></textarea>
                <label for="gambar">Gambar</label>
                <input type="file" name="gambar" class="inputgambar" accept="image/*" >
                <input type="submit" name="ubah" value="Edit Data" class="add-btn">
            </form>
        </div>
    </section>
</body>
</html>