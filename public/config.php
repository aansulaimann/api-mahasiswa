<?php

// Koneksi database
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'db_kemahasiswaan';

// create connection
$conn = new mysqli($servername, $username, $password, $dbname);

function cekAPIKey($id)
{
    global $conn;

    $sql = "SELECT key_token FROM tb_user WHERE id='$id'";
    $res = $conn->query($sql);

    if ($res->num_rows > 0) {
        return $res->fetch_all(MYSQLI_ASSOC);
    }
}
