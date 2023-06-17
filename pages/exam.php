
<?php
include('../connect.php');
session_start();
extract($_POST);
   $sql = "INSERT INTO exam_scheduling (course_code,exam_date,start_time,end_time) VALUES ('$course_code',TO_DATE('$exam_date','YYYY-MM-DD'),TO_TIMESTAMP('$start_time','HH24:MI'),TO_TIMESTAMP('$end_time','HH24:MI'))";
   $parse = oci_parse($conn,$sql);
   oci_execute($parse);
   $r = oci_commit($conn);
 if ($r) {
      $_SESSION['success']=' Record Successfully Added';
     ?>
<script type="text/javascript">
window.location="../view_exam.php";
</script>
<?php
} else {
      $_SESSION['error']='Something Went Wrong';
?>
<script type="text/javascript">
window.location="../view_exam.php";
</script>
<?php } ?>




