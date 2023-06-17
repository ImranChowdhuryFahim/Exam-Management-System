<?php
include 'connect.php';
session_start();

$sql = "DELETE FROM exam_scheduling WHERE course_code='".$_GET["course_code"]."' and exam_date='".$_GET["exam_date"]."'";
$parse = oci_parse($conn,$sql);
oci_execute($parse);
$r= oci_commit($conn);
 $_SESSION['success']=' Record Successfully Deleted';
?>
<script>

window.location = "view_exam.php";
</script>

