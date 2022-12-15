<?php

require_once 'config/config.php';

// array untuk menampung result
$result = array();

// cek API KEY / TOKEN
$res = getAllDataWhere('tb_user', $key);

if ($res->num_rows > 0) {
    // cek validasi request method
    if ($method == 'GET') {
        $result['status'] = [
            'code' => 200,
            'description' => 'Request Valid : OK'
        ];

        $result['results'] = getAllData('tb_mahasiswa');
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
