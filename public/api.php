<?php session_start();
require_once 'config.php';
// cek session
if (isset($_SESSION['session']) === false) {
    header('Location: http://localhost/api-mahasiswa/auth/');
}

if (isset($_POST['signout'])) {
    $_SESSION = array();
    session_destroy();
    header('Location: http://localhost/api-mahasiswa/auth/');
    exit;
}

$id = $_SESSION['id'];
$token = cekAPIKey($id)[0]['key_token'];



if (isset($_POST['generate'])) {
    $token = "token-api-key" . $_SESSION['username'] . 'api-by-github.com/aansulaimann';
    $token = md5($token);
    $token = password_hash($token, PASSWORD_DEFAULT);

    $id = $_SESSION['id'];

    $sql = "UPDATE tb_user SET key_token='$token' WHERE id='$id'";
    $conn->query($sql);
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Dashboard | Student API</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/dashboard/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">Student API</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <form action="" method="post">
                    <!-- <a class="nav-link px-3" href="#">Sign out</a> -->
                    <button class="nav-link px-3 bg-dark border-0" type="submit" name="signout">Sign out</button>
                </form>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3 sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">
                                <span data-feather="home" class="align-text-bottom"></span>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="api.php">
                                <span data-feather="file" class="align-text-bottom"></span>
                                API
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                        <span>Saved reports</span>
                        <a class="link-secondary" href="#" aria-label="Add a new report">
                            <span data-feather="plus-circle" class="align-text-bottom"></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="file-text" class="align-text-bottom"></span>
                                Current month
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">APIs Section</h1>
                </div>
                <h6 class="mt-3">Generate API KEY or TOKEN</h6>
                <form action="" method="post" class="bg-light p-3 mb-2">
                    <h6><b>Your API KEY : </b></h6> <?php echo isset($token) ? $token : ''; ?> <br>
                    <button class="btn btn-sm btn-info text-white mt-4" type="submit" name="generate">Generate</button>
                    <hr>
                </form>

                <h6>End Points</h6>
                <div class="table-responsive col-lg-10 mt-3">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Method</th>
                                <th scope="col">Url</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Get All student data</td>
                                <td>GET</td>
                                <td>http://localhost/api-mahasiswa/student</td>
                                <td> <button class="btn badge bg-success">copy</button> </td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>Get one student data by NIM</td>
                                <td>GET</td>
                                <td>http://localhost/api-mahasiswa/student?nim=nim
                                </td>
                                <td> <button class="btn badge bg-success">copy</button> </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Insert One Data</td>
                                <td>POST</td>
                                <td>http://localhost/api-mahasiswa/student=add
                                </td>
                                <td> <button class="btn badge bg-success">copy</button> </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Update One Data</td>
                                <td>POST</td>
                                <td>http://localhost/api-mahasiswa/student=put
                                </td>
                                <td> <button class="btn badge bg-success">copy</button> </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Delete One Data</td>
                                <td>DELETE</td>
                                <td>http://localhost/api-mahasiswa/student=delete
                                </td>
                                <td> <button class="btn badge bg-success">copy</button> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="dashboard.js"></script>
</body>

</html>