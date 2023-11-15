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
        header("Location: index.php");
        exit;
    }

    if(!$isset)
    $gambar_lama = mysqli_query($conn, "SELECT gambar FROM resep where id = $id"); 
    $row = mysqli_fetch_assoc($gambar_lama);
    $nama_file = $row['gambar'];

    $get = mysqli_query($conn, "DELETE FROM resep WHERE id = $id");
    $karakter = [];

    $lokasi_file = '../assets/uploadedImg/' . $nama_file; 

    if($nama_file != "NoImage.png"){
        if (file_exists($lokasi_file)) {
            unlink($lokasi_file);
        } 
    } 

    if ($get) {
        echo "
        <script>
            alert('Data berhasil dihapus!');
            document.location.href = 'dashboard.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Data gagal dihapus!');
            document.location.href = 'dashboard.php';
        </script>";
    }
?>