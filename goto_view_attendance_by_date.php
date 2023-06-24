<?php
session_start();
extract($_POST);


$_SESSION['room_no']= $room_no;

?>

<script type="text/javascript">
window.location="view_attendance_by_date.php";
</script>

