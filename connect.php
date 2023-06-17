<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "exam_hall";


$conn = oci_connect("halltracker_admin", "1234", "//localhost:/orcldb");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



?> 