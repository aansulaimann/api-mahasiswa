<?php

session_start();

// require_once './config/config.php';
// Koneksi database
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'db_kemahasiswaan';

// create connection
$conn = new mysqli($servername, $username, $password, $dbname);

function cekLogin($data)
{
    global $conn;

    $username = htmlspecialchars(trim($data['username']));
    $password = htmlspecialchars(trim($data['password']));

    $sql = "SELECT * FROM tb_user WHERE username='$username'";
    $res = $conn->query($sql);

    if ($res->num_rows > 0) {
        $data = $res->fetch_all(MYSQLI_ASSOC)[0];
        if (password_verify($password, $data['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $data['id'];
            $_SESSION['session'] = true;
            return 1;
        } else {
            return 0;
        }
    } else {
        return 0;
    }
}

function registNewUser($data)
{
    global $conn;

    $username = htmlspecialchars(trim($data['username_regist']));
    $password = htmlspecialchars(trim($data['password_regist']));

    $sql = "SELECT * FROM tb_user WHERE username='$username'";
    $res = $conn->query($sql);

    if ($res->num_rows > 0) {
        return 0;
    } else {
        $hash_pwd = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO tb_user (username, password) VALUES ('$username', '$hash_pwd')";
        $conn->query($sql);
        return 1;
    }
}
