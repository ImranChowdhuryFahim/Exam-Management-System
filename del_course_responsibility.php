<?php
include 'connect.php';
session_start();

$sql = "DELETE FROM courses_responsibility WHERE course_code='".$_GET["course_code"]."' and teacher_id='" . $_GET["teacher_id"] . "' and section='" . $_GET['section'] . "'";
$parse = oci_parse($conn,$sql);
oci_execute($parse);
 $_SESSION['success']=' Record Successfully Deleted';
?>
<script>

window.location = "view_course_responsibility.php";
</script>

