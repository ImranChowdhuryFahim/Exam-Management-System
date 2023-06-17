
<?php
include('../connect.php');
session_start();
extract($_POST);
   $sql = "INSERT INTO courses (course_code,course_title,course_name) VALUES ('$course_code','$course_title','$course_name')";
   $parse = oci_parse($conn,$sql);
   oci_execute($parse);
   $r = oci_commit($conn);
   if ($r) {
      $_SESSION['success']=' Record Successfully Added';
     ?>
<script type="text/javascript">
window.location="../view_course.php";
</script>
<?php
} else {
      $_SESSION['error']='Something Went Wrong';
?>
<script type="text/javascript">
window.location="../view_course.php";
</script>
<?php } ?>




