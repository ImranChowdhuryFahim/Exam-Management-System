<?php
session_start();
extract($_POST);


$_SESSION['course_code']= $course_code;

?>

<script type="text/javascript">
window.location="view_students_marks.php";
</script>

