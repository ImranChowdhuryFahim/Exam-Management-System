<?php
include 'connect.php';
session_start();

$sql = "DELETE FROM student WHERE student_id='".$_GET["id"]."'";
$parse = oci_parse($conn,$sql);
oci_execute($parse);
$sql = "DELETE FROM login WHERE email='".$_GET["email"]."'";
$parse = oci_parse($conn,$sql);
oci_execute($parse);
$r = oci_commit($conn);
 $_SESSION['success']=' Record Successfully Deleted';
?>
<script>

window.location = "view_student.php";
</script>

