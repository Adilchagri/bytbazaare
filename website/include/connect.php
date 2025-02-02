<?php
$con = mysqli_connect('localhost', 'root', '', 'bytebazaar');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>