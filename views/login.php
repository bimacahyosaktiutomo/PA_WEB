<?php 
    session_start();
    require '../include/connect.php';

    if(isset($_SESSION['admin'])  or isset($_SESSION['username'])){
        header("Location: index.php");
        exit;
    }

    if(isset($_POST['register'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $cpass = $_POST['cpassword'];

        if ($pass === $cpass){
            $pass = password_hash($pass, PASSWORD_DEFAULT);
            
            $result = mysqli_query($conn, "SELECT USERNAME FROM USER WHERE USERNAME='$username'");

            if(mysqli_fetch_assoc($result)){
                echo "
                <script>
                    alert('Username Sudah Digunakan !');
                    document.location.href = 'login.php';
                </script>";
            } else {
                $sql = "INSERT INTO USER VALUES('','$username','$email','$pass')";
                $result = mysqli_query($conn, $sql);

                if(mysqli_affected_rows($conn) > 0){
                    echo "
                    <script>
                        alert('Registrasi Berhasil !');
                        document.location.href = 'login.php';
                    </script>";
                } else {
                    echo "
                    <script>
                        alert('Registrasi Gagal !');
                        document.location.href = 'login.php';
                    </script>";
                }
            }

        } else {
            echo "<script>
                alert('Konfirmasi Password Tidak Sesuai !');
                document.location.href = 'login.php';
            </script>";
        }
    }

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $result = mysqli_query($conn, "SELECT * FROM USER WHERE username='$username'");
        if (mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);
            
            if ($username == 'admin' and $password == 'admin'){
                // $_SESSION['login'] = true;
                $_SESSION['admin'] = $username;
                header("Location: dashboard.php");
                exit;
            }

            if(password_verify($password, $row['password'])){
                // $_SESSION['login'] = true;
                $_SESSION['username'] = $username;

                header("Location: index.php");
                exit;
            }    
        }
        $error = true;        
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Ifandi's Taste</title>
    <link rel="icon" href="../assets/webicon.png">
	<link rel="stylesheet" href="../styles/login.css">
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk">
        <div class="signup">
            <form action="" method="POST">
                <label for="chk">Sign up</label>
                <input type="text" name="username" placeholder="Username" required="">
                <input type="email" name="email" placeholder="Email" required="">
                <input type="password" name="password" placeholder="Password" required="">                
                <input type="password" name="cpassword" placeholder="Password Confirmation" required="">                
                <input type="submit" name="register" value="Register" class="btn">
            </form>
        </div>

        <div class="login">
            <form action="" method="POST">
                <label for="chk">Login</label>
                <?php 
                    if(isset($error)){
                        echo '<script>document.getElementById("chk").checked = true;</script>';
                        echo "<p style='text-align:center; color:white;'>Username atau Password Salah !</p>";
                    } 
                ?>
                <input type="text" name="username" placeholder="Username" required="">
                <input type="password" name="password" placeholder="Password" required="">                
                <input type="submit" name="login" value="Login" class="btn">
            </form>
        </div>    
	</div>
</body>
</html>