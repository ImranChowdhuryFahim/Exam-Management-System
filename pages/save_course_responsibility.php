
<?php
include('../connect.php');
session_start();
extract($_POST);
   $sql = "INSERT INTO COURSES_RESPONSIBILITY (course_code,teacher_id,section) VALUES ('$course_code','$teacher_id','$section')";
   $parse = oci_parse($conn,$sql);
   $t = oci_execute($parse);
   $r = oci_commit($conn);
   if ($r && $t) {
      $_SESSION['success']=' Record Successfully Added';
     ?>
<script type="text/javascript">
window.location="../view_course_responsibility.php";
</script>
<?php
} else {
      $_SESSION['error']='Something Went Wrong';
?>
<script type="text/javascript">
window.location="../view_course_responsibility.php";
</script>
<?php } ?>




