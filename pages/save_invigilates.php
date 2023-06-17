
<?php
include('../connect.php');
session_start();
extract($_POST);
   $sql = "INSERT INTO INVIGILATES (room_no,teacher_id,exam_date) VALUES ('$room_no','$teacher_id','$exam_date')";
   $parse = oci_parse($conn,$sql);
   oci_execute($parse);
   $r = oci_commit($conn);
 if ($r) {
      $_SESSION['success']=' Record Successfully Added';
     ?>
<script type="text/javascript">
window.location="../view_invigilator.php";
</script>
<?php
} else {
      $_SESSION['error']='Something Went Wrong';
?>
<script type="text/javascript">
window.location="../view_invigilator.php";
</script>
<?php } ?>




