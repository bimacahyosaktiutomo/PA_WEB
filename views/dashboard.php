<?php
    session_start();
    require "../include/connect.php";

    if(!isset($_SESSION['admin'])){
        header("Location: index.php");
        exit;
    }
    
    if(isset($_POST['keyword'])){
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
                        <a href="index.php">
                            <i class="fa-solid fa-newspaper"></i>
                            <h3>Kembali</h3>
                        </a>
                    </div>
                    <div class="nav-option option3">
                        <i class="fa-solid fa-newspaper"></i>
                        <h3> Settings</h3>
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

            <div class="box-container">

                <div class="box box1">
                    <div class="text">
                        <h2 class="topic-heading">60.5k</h2>
                        <h2 class="topic">Article Views</h2>
                    </div>
                    <!-- <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210184645/Untitled-design-(31).png" alt="Views"> -->
                </div>

                <div class="box box2">
                    <div class="text">
                        <h2 class="topic-heading">150</h2>
                        <h2 class="topic">Likes</h2>
                    </div>
                    <!-- <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210185030/14.png" alt="likes"> -->
                </div>

                <div class="box box3">
                    <div class="text">
                        <h2 class="topic-heading">320</h2>
                        <h2 class="topic">Comments</h2>
                    </div>
                    <!-- <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210184645/Untitled-design-(32).png" alt="comments"> -->
                </div>

                <div class="box box4">
                    <div class="text">
                        <h2 class="topic-heading">70</h2>
                        <h2 class="topic">Published</h2>
                    </div>
                    <!-- <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210185029/13.png" alt="published"> -->
                </div>
            </div>

            <div class="report-container">
                <div class="report-header">
                    <h1 class="recent-Articles">Recent Articles</h1>
                    <a href="tambah_data.php?id=1"><button class="tambah">Tambah Data +</button></a>                    
                </div>

                <div class="report-body">
                    <!-- <div class="report-topic-heading">
                        <h3 class="t-op">UID</h3>
                        <h3 class="t-op">ID Resep</h3>
                        <h3 class="t-op">Nama Resep</h3>
                        <h3 class="t-op">Deskripsi</h3>
                        <h3 class="t-op">Gambar</h3>
                    </div> -->

                    <div class="items">
                        <!-- <?php $i = 1; foreach ($resep as $rsp) :?> -->
                            <!-- <div class="item1">                        
                                <h3 class="t-op-nextlvl"><?php echo $rsp['uid']; ?></h3>
                                <h3 class="t-op-nextlvl"><?php echo $rsp['id_resep']; ?></h3>
                                <h3 class="t-op-nextlvl"><?php echo $rsp['nama_resep']; ?></h3>
                                <h3 class="t-op-nextlvl"><?php echo $rsp['deskripsi']; ?></h3>
                                <img src="../assets/uploadedImg/<?php echo $rsp['gambar']; ?>" alt="" height="100px">
                                <div class="action">
                                    <a href="edit.php?id=<?php echo $rsp['id_resep']?>"><button class="edit-btn"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" fill="white"><path d="M200-200h56l345-345-56-56-345 345v56Zm572-403L602-771l56-56q23-23 56.5-23t56.5 23l56 56q23 23 24 55.5T829-660l-57 57Zm-58 59L290-120H120v-170l424-424 170 170Zm-141-29-28-28 56 56-28-28Z"/></svg></button></a>
                                    <a href="delete.php?id=<?php echo $rsp['id_resep']?>"><button class="delete-btn" onclick="confirm('Yakin ingin menghapus <?php echo $mhs['nama']?>?')"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" fill="white"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg></button></a>
                                </div>
                            </div> -->
                            <!-- <?php $i++; endforeach; ?> -->
                        <table>
                        <thead>
                            <tr>
                                <th><h3 class="t-op">UID</h3></th>
                                <th><h3 class="t-op">ID Resep</h3></th>
                                <th><h3 class="t-op">Nama Resep</h3></th>
                                <th><h3 class="t-op">Deskripsi</h3></th>
                                <th><h3 class="t-op">Gambar</h3></th>
                                <th><h3 class="t-op">Aksi</h3></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; foreach ($resep as $rsp) :?>
                            <tr>
                                <td><?php echo $rsp['uid']; ?></td>
                                <td><?php echo $rsp['id_resep']; ?></td>
                                <td><?php echo $rsp['nama_resep']; ?> </td>
                                <td><?php echo $rsp['deskripsi']; ?></td> 
                                <td><img src="../assets/uploadedImg/<?php echo $rsp['gambar']; ?>" alt="" height="100px"></td>                                
                                <td class="action">
                                    <a href="edit_data.php?id=<?php echo $rsp['id_resep']?>"><button class="edit-btn"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" fill="white"><path d="M200-200h56l345-345-56-56-345 345v56Zm572-403L602-771l56-56q23-23 56.5-23t56.5 23l56 56q23 23 24 55.5T829-660l-57 57Zm-58 59L290-120H120v-170l424-424 170 170Zm-141-29-28-28 56 56-28-28Z"/></svg></button></a>
                                    <a href="hapus_data.php?id=<?php echo $rsp['id_resep']?>"><button class="delete-btn" onclick="confirm('Yakin ingin menghapus <?php echo $rsp['nama_resep']?>?')"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" fill="white"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg></button></a>
                                </td>
                            </tr>
                        <?php $i++; endforeach; ?>
                        </tbody>
                        </table>
                        <div class="item1">
                            <h3 class="t-op-nextlvl">Article 73</h3>
                            <h3 class="t-op-nextlvl">2.9k</h3>
                            <h3 class="t-op-nextlvl">210</h3>
                            <h3 class="t-op-nextlvl">210</h3>
                            <h3 class="t-op-nextlvl label-tag">Published</h3>
                        </div>

                        <div class="item1">
                            <h3 class="t-op-nextlvl">Article 72</h3>
                            <h3 class="t-op-nextlvl">1.5k</h3>
                            <h3 class="t-op-nextlvl">360</h3>
                            <h3 class="t-op-nextlvl">360</h3>
                            <h3 class="t-op-nextlvl label-tag">Published</h3>
                        </div>

                        <div class="item1">
                            <h3 class="t-op-nextlvl">Article 71</h3>
                            <h3 class="t-op-nextlvl">1.1k</h3>
                            <h3 class="t-op-nextlvl">150</h3>
                            <h3 class="t-op-nextlvl">150</h3>
                            <h3 class="t-op-nextlvl label-tag">Published</h3>
                        </div>

                        <div class="item1">
                            <h3 class="t-op-nextlvl">Article 70</h3>
                            <h3 class="t-op-nextlvl">1.2k</h3>
                            <h3 class="t-op-nextlvl">420</h3>
                            <h3 class="t-op-nextlvl">420</h3>
                            <h3 class="t-op-nextlvl label-tag">Published</h3>
                        </div>

                        <div class="item1">
                            <h3 class="t-op-nextlvl">Article 69</h3>
                            <h3 class="t-op-nextlvl">2.6k</h3>
                            <h3 class="t-op-nextlvl">190</h3>
                            <h3 class="t-op-nextlvl">190</h3>
                            <h3 class="t-op-nextlvl label-tag">Published</h3>
                        </div>

                        <div class="item1">
                            <h3 class="t-op-nextlvl">Article 68</h3>
                            <h3 class="t-op-nextlvl">1.9k</h3>
                            <h3 class="t-op-nextlvl">390</h3>
                            <h3 class="t-op-nextlvl">390</h3>
                            <h3 class="t-op-nextlvl label-tag">Published</h3>
                        </div>

                        <div class="item1">
                            <h3 class="t-op-nextlvl">Article 67</h3>
                            <h3 class="t-op-nextlvl">1.2k</h3>
                            <h3 class="t-op-nextlvl">580</h3>
                            <h3 class="t-op-nextlvl">580</h3>
                            <h3 class="t-op-nextlvl label-tag">Published</h3>
                        </div>

                        <div class="item1">
                            <h3 class="t-op-nextlvl">Article 66</h3>
                            <h3 class="t-op-nextlvl">3.6k</h3>
                            <h3 class="t-op-nextlvl">160</h3>
                            <h3 class="t-op-nextlvl">160</h3>
                            <h3 class="t-op-nextlvl label-tag">Published</h3>
                        </div>

                        <div class="item1">
                            <h3 class="t-op-nextlvl">Article 65</h3>
                            <h3 class="t-op-nextlvl">1.3k</h3>
                            <h3 class="t-op-nextlvl">220</h3>
                            <h3 class="t-op-nextlvl">220</h3>
                            <h3 class="t-op-nextlvl label-tag">Published</h3>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../scripts/dashboard.js"></script>
</body>

</html>