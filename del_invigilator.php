<?php
include 'connect.php';
session_start();

$sql = "DELETE FROM INVIGILATES WHERE room_no='".$_GET["room_no"]."' and teacher_id='" . $_GET["teacher_id"] . "' and exam_date='".$_GET["exam_date"]."'";
$parse = oci_parse($conn,$sql);
oci_execute($parse);
$r= oci_commit($conn);
 $_SESSION['success']=' Record Successfully Deleted';
?>
<script>

window.location = "view_invigilator.php";
</script>

