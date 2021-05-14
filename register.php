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

<body>
    <div style="background: linear-gradient(90deg,#2b32b2,#1488cc)">
        <div class="page container d-flex justify-content-center align-items-center">
            <div class=" login__wrapper">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Register</h2>
                    <small>Masuk ke akun menggunakan email dan password.</small>
                </div>
                <form>
                    <div class="form-group mb-3">
                        <label class="form-label">Full Name</label>
                        <input class="form-control" type="text">
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Email</label>
                        <input class="form-control" type="email">
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label">Password</label>
                        <input class="form-control" type="password">
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label">Confirm Password</label>
                        <input class="form-control" type="password">
                    </div>
                    <div class="form-button w-100">
                        <button class="btn btn-primary w-100">Register</button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <p>Sudah punya akun?</p>
                    <a class="btn btn-secondary" href="login.php">Login</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>