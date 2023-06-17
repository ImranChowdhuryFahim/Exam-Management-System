<?php
include 'connect.php';
session_start();

$sql = "BEGIN 
DELETE FROM attendance WHERE course_code='".$_GET["course_code"]."' and student_id='" . $_SESSION["id"] . "' and exam_date='".$_GET["exam_date"]."';
DELETE FROM marks_obtained WHERE course_code='".$_GET["course_code"]."' and student_id='" . $_SESSION["id"] . "';
END;";
$parse = oci_parse($conn,$sql);
oci_execute($parse);
$r= oci_commit($conn);
 $_SESSION['success']=' Record Successfully Deleted';
?>
<script>

window.location = "student_panel.php";
</script>

