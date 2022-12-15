<?php

require_once './config/config.php';

// array untuk menampung result
$result = array();

// cek API KEY / TOKEN
$res = getAllDataWhere('tb_user', $key);

if ($res->num_rows > 0) {
    // cek validasi request method
    if ($method == 'GET') {
        // pengecekan parameter
        if (isset($_GET['nim'])) {
            // menangkap parameter
            $param = $_GET['nim'];

            // query select
            $sql = "SELECT * FROM tb_mahasiswa WHERE nim = '$param'";
            // eksekusi query
            $hasil_query = queryData($sql);

            if ($hasil_query->num_rows > 0) {
                // masukan results ke dalam array result
                $result['results'] = $hasil_query->fetch_all(MYSQLI_ASSOC);

                // result status code
                $result['status'] = [
                    'code' => 200,
                    'description' => 'Request Valid : OK'
                ];
            } else {
                $result['results'] = [
                    'code' => 400,
                    'description' => 'Data Not Found'
                ];
            }
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
            'description' => 'ERR: Request NOT Valid'
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
