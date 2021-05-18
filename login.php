<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="assets/style.css" rel="stylesheet" type="text/css">
</head>
<?php
session_start();

if (isset($_SESSION['isLogged'])) {
    header("location: index.php");
    exit();
}

require_once("class/user.php");
$user = new User();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty(trim($_POST['email']))) {
        echo '<script>alert("Email cannot be empty")</script>';
        return;
    }

    if (empty($_POST['password'])) {
        echo '<script>alert("Password cannot be empty")</script>';
        return;
    }

    $try_login = $user->login($_POST['email'], $_POST['password']);
    if ($try_login != null) {
?>
        <script>
            localStorage.setItem("user_id", <?php echo $try_login ?>);
            setTimeout(() => {
                window.location.href = "index.php";
            }, 500);
        </script>
<?php

        $_SESSION["isLogged"] = true;
        $_SESSION['id'] = $try_login;

        // header("location: index.php");
    } else {
        echo '<script>alert("Email or password not matched!")</script>';
    }
}

?>

<body>
    <div style="background: linear-gradient(90deg,#2b32b2,#1488cc)">
        <div class="page container d-flex justify-content-center align-items-center">
            <div class=" login__wrapper">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Login</h2>
                    <small>Masuk ke akun menggunakan email dan password.</small>
                </div>
                <form action="" method="POST">
                    <div class="form-group mb-3">
                        <label class="form-label">Email</label>
                        <input class="form-control" type="email" name="email">
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label">Password</label>
                        <input class="form-control" type="password" name="password">
                    </div>
                    <div class="form-button w-100">
                        <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <p>Tidak punya akun?</p>
                    <a class="btn btn-secondary" href="register.php">Register</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>