<?php

$host = 'localhost/api-mahasiswa/';
$getUrls = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$getUrls = explode('/', $getUrls);
$res = array();

if (isset($getUrls[2])) {
    if ($getUrls[2] === "student") {
        require_once 'api/getAllData.php';
    } else if (strpos($getUrls[2], '?nim')) {
        require_once 'api/getOneData.php';
    } else if ($getUrls[2] == 'student=add') {
        require_once 'api/insertData.php';
    } else if ($getUrls[2] == 'student=put') {
        require_once 'api/putUpdateData.php';
    } else if ($getUrls[2] == 'student=delete') {
        require_once 'api/deleteData.php';
    } else {
        $res['message'] = [
            'code' => 400,
            'message' => 'ERR: Request invalid'
        ];
    }
} else {
    $res['message'] = [
        'code' => 400,
        'message' => 'ERR: Request invalid'
    ];
    echo json_encode($res);
}
