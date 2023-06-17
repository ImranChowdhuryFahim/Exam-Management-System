<?php
include 'connect.php';
session_start();

$sql = "DELETE FROM courses WHERE course_code='".$_GET["course_code"]."'";
$parse = oci_parse($conn,$sql);
oci_execute($parse);
 $_SESSION['success']=' Record Successfully Deleted';
?>
<script>

window.location = "view_course.php";
</script>

