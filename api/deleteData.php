<?php

require_once './config/config.php';

// array untuk menampung result
$result = array();

// cek API KEY / TOKEN
$res = getAllDataWhere('tb_user', $key);

if ($res->num_rows > 0) {
    // cek validasi request method
    if ($method == 'DELETE') {

        // mengambil raw input
        parse_str(file_get_contents("php://input"), $_DELETE);

        // pengecekan parameter
        if (isset($_DELETE['id'])) {

            // menangkap parameter
            $id = $_DELETE['id'];

            // result status code
            $result['status'] = [
                'code' => 200,
                'description' => '1 data deleted : OK'
            ];

            // TO-DO
            // Koneksi database
            $servername = 'localhost';
            $username = 'root';
            $password = '';
            $dbname = 'db_kemahasiswaan';

            // create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // query select
            $sql = "DELETE FROM tb_mahasiswa WHERE id='$id'";
            // eksekusi query
            $conn->query($sql);

            // masukan results ke dalam array result
            $result['results'] = [
                'id' => $id,
                'description' => "Data with id " . $id . " has been deleted!"
            ];
        } else {
            // result status code
            $result['status'] = [
                'code' => 400,
                'description' => 'ERR: Parameter invalid'
            ];
        }
    } else {
        $result['status'] = [
            'code' => 400,
            'description' => 'ERR: Request invalid'
        ];
    }
} else {
    $result['status'] = [
        'code' => 400,
        'description' => 'ERR: Request API KEY OR TOKEN invalid'
    ];
}


// tampilkan data dalam format json
echo json_encode($result);
