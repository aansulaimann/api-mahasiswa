<?php
// ubah header menjadi json
header('Content-Type:application/json');

// menangkap header
$header = apache_request_headers();

$key = $header['key'];
