<?php
$h = 'localhost';
$u = 'id12407698_test_usr';
$p = '1qaz@WSX';
$d = 'id12407698_test_db';

$conn = new mysqli($h, $u, $p, $d);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}