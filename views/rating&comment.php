<?php
session_start();
require "../include/connect.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

var_dump($_POST);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_resep = $_POST['id_resep'];
    $uid = $_POST['uid'];

    if (isset($_POST['rate_' . $id_resep])) {
        $rating = $_POST['rate_' . $id_resep];
    } else {
        echo "Error: Rating key is not present in the POST data.";
        header("Location: resep.php?id=$id_resep");
        exit();
    }

    if (isset($_POST['comment_' . $id_resep])) {
        $comment = $_POST['comment_' . $id_resep];
    } else {
        echo "Error: Comment key is not present in the POST data.";
        header("Location: resep.php?id=$id_resep");
        exit();
    }

    $checkQuery = "SELECT * FROM rating WHERE uid = '$uid' AND id_resep = '$id_resep'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $updateQuery = "UPDATE rating SET rating = '$rating', komentar = '$comment' WHERE uid = '$uid' AND id_resep = '$id_resep'";
        if (mysqli_query($conn, $updateQuery)) {
            header("Location: resep.php?id=$id_resep");
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($conn);
            header("Location: resep.php?id=$id_resep");
        }
    } else {
        $insertQuery = "INSERT INTO rating VALUES ('', '$uid', '$id_resep', '$rating', '$comment')";
        if (mysqli_query($conn, $insertQuery)) {
            header("Location: resep.php?id=$id_resep");
            exit();
        } else {
            header("Location: resep.php?id=$id_resep");
            echo "Error inserting record: " . mysqli_error($conn);
        }
    }
} else {
    header("Location: lihat.php");
    exit();
}
?>
