<?php
session_start();
extract($_POST);


$_SESSION['exam_date']= $exam_date;

?>

<script type="text/javascript">
window.location="view_attendance.php";
</script>

