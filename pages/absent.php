
<?php
include('../connect.php');
session_start();
extract($_GET);

   $sql = "UPDATE attendance set status='A' where course_code='" . $course_code . "' and student_id='" . $student_id . "' and exam_date='" . $exam_date . "'";
   $parse = oci_parse($conn,$sql);
   oci_execute($parse);
   $r = oci_commit($conn);
   if ($r) {
      $_SESSION['success']=' Record Successfully Added';
     ?>
<script type="text/javascript">
window.location="../view_attendance.php";
</script>
<?php
} else {
      $_SESSION['error']='Something Went Wrong';
?>
<script type="text/javascript">
window.location="../view_attendance.php";
</script>
<?php } ?>




