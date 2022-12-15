<?php

require_once './config/config.php';

// array untuk menampung result
$result = array();

// cek API KEY / TOKEN
$res = getAllDataWhere('tb_user', $key);

if ($res->num_rows > 0) {
    // cek validasi request method
    if ($method == 'POST') {
        // pengecekan parameter
        if (isset($_POST['nim']) && isset($_POST['nama']) && isset($_POST['alamat'])) {

            // menangkap parameter
            $nim = $_POST['nim'];
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];

            // tangkap foto
            $foto_tmp = $_FILES['foto']['tmp_name'];
            $ekst = explode('.', $_FILES['foto']['name']);
            $nama_foto = "img-" . time() . "." . end($ekst);

            // pindahkan dari tmp location ke lokasi permanen
            move_uploaded_file($foto_tmp, 'foto/' . $nama_foto);

            // TO-DO
            // query insert
            $sql = "INSERT INTO tb_mahasiswa (nim, nama, alamat, foto) VALUES ('$nim', '$nama', '$alamat', '$nama_foto')";
            insertData($sql);

            // result status code
            $result['status'] = [
                'code' => 200,
                'description' => '1 data inserted : OK'
            ];

            // masukan results ke dalam array result
            $result['results'] = [
                'nim' => $nim,
                'nama' => $nama,
                'alamat' => $alamat,
                'foto' => $nama_foto
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
