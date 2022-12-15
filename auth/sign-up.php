<?php

require_once 'config.php';

if (isset($_POST['signup'])) {
    if (registNewUser($_POST) > 0) {
        echo '<div class="alert alert-success" role="alert">
        Sign up success please <a href="http://localhost/api-mahasiswa/auth/" class="alert-link">sign in</a>. thank you!
      </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">
        Ooopss! Sign up invalid, please check your <b>username or password</b>. thank you!
      </div>';
    }
}

// cek session
if (isset($_SESSION['session']) === true) {
    header('Location: http://localhost/api-mahasiswa/public/');
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign up | Student API</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-6">
                <form action="" method="POST">
                    <h1 class="h3 mb-3 fw-normal">Please sign up</h1>

                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingInput" placeholder="person" name="username_regist">
                        <label for="floatingInput">username</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="passwer34" name="password_regist">
                        <label for="floatingPassword">password</label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary mt-3 mb-2" type="submit" name="signup">Sign up</button>
                    <a href="http://localhost/api-mahasiswa/auth/" class="text-decoration-none">sign in</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
</body>

</html>