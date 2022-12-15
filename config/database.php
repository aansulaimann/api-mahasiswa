<?php

// Koneksi database
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'db_kemahasiswaan';

// create connection
$conn = new mysqli($servername, $username, $password, $dbname);

function queryData($sql)
{
    global $conn;
    // eksekusi query
    return $conn->query($sql);
}

// function get all data
function getAllData($table)
{
    // TO-DO
    // query select
    global $conn;
    $sql = "SELECT * FROM $table";
    // eksekusi query
    $result = $conn->query($sql);

    // masukan results ke dalam array result
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getAllDataWhere($table, $where)
{
    global $conn;
    // cek api key / token
    $sql = "SELECT * FROM $table WHERE key_token='$where'";
    return $conn->query($sql);
}

function insertData($query)
{
    global $conn;
    // query insert
    $sql = $query;
    // eksekusi query
    $conn->query($sql);
}

function update($sql)
{
    global $conn;

    $conn->query($sql);
}
