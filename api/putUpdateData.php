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
        if (isset($_POST['nim']) && isset($_POST['nama']) && isset($_POST['alamat']) && isset($_POST['id'])) {
            // menangkap parameter
            $nim = $_POST['nim'];
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $id = $_POST['id'];

            if (isset($_FILES['foto'])) {

                // tangkap foto
                $foto_tmp = $_FILES['foto']['tmp_name'];
                $ekst = explode('.', $_FILES['foto']['name']);
                $nama_foto = "img-" . time() . "." . end($ekst);

                // pindahkan dari tmp location ke lokasi permanen
                move_uploaded_file($foto_tmp, 'foto/' . $nama_foto);

                // TO-DO
                // query update
                $sql = "UPDATE tb_mahasiswa SET nim='$nim', nama='$nama', alamat='$alamat', foto='$nama_foto' WHERE id='$id'";
                update($sql);
                // $conn->query($sql);

                // result status code
                $result['status'] = [
                    'code' => 200,
                    'description' => '1 data updated : OK'
                ];

                // masukan results ke dalam array result
                $result['results'] = [
                    'nim' => $nim,
                    'nama' => $nama,
                    'alamat' => $alamat,
                    'foto' => $nama_foto
                ];
            } else {
                // TO-DO
                // query update
                $sql = "UPDATE tb_mahasiswa SET nim='$nim', nama='$nama', alamat='$alamat' WHERE id='$id'";
                // queryData($sql);

                // $sql = "INSERT INTO tb_mahasiswa (nim, nama, alamat) VALUES ('$nim', '$nama', '$alamat')";
                update($sql);
                // $conn->query($sql);

                // result status code
                $result['status'] = [
                    'code' => 200,
                    'description' => '1 data updated : OK'
                ];

                // masukan results ke dalam array result
                $result['results'] = [
                    'nim' => $nim,
                    'nama' => $nama,
                    'alamat' => $alamat,
                    'foto' => $nama_foto
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



// // ubah header menjadi json
// header('Content-Type:application/json');

// // tangkap request method untuk divalidasi
// $method = $_SERVER['REQUEST_METHOD'];

// // array untuk menampung result
// $result = array();

// // cek validasi request method
// if ($method == 'PUT') {

//     // mengambil raw input
//     parse_str(file_get_contents("php://input"), $_PUT);

//     // pengecekan parameter
//     if (isset($_POST['nim']) && isset($_POST['nama']) && isset($_POST['alamat']) && isset($_POST['id'])) {

//         // menangkap parameter
//         $nim = $_POST['nim'];
//         $nama = $_POST['nama'];
//         $alamat = $_POST['alamat'];
//         $foto = $_POST['foto'];
//         $id = $_POST['id'];

//         // result status code
//         $result['status'] = [
//             'code' => 200,
//             'description' => '1 data updated : OK'
//         ];

//         // TO-DO
//         // Koneksi database
//         $servername = 'localhost';
//         $username = 'root';
//         $password = '';
//         $dbname = 'db_kemahasiswaan';

//         // create connection
//         $conn = new mysqli($servername, $username, $password, $dbname);

//         // query select
//         $sql = "UPDATE tb_mahasiswa SET nim='$nim', nama='$nama', alamat='$alamat', foto='$foto' WHERE id='$id'";
//         // eksekusi query
//         $conn->query($sql);

//         // masukan results ke dalam array result
//         $result['results'] = [
//             'nim' => $nim,
//             'nama' => $nama,
//             'alamat' => $alamat
//         ];
//     } else {
//         // result status code
//         $result['status'] = [
//             'code' => 400,
//             'description' => 'ERR: Parameter invalid'
//         ];
//     }
// } else {
//     $result['status'] = [
//         'code' => 400,
//         'description' => 'ERR: Request invalid'
//     ];
// }

// // tampilkan data dalam format json
// echo json_encode($result);
