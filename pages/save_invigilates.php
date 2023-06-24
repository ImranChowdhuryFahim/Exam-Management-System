
<?php
include('../connect.php');
session_start();
extract($_POST);

function exceptions_error_handler($severity, $message, $filename, $lineno) {
      throw new Exception("Already assigned to an exam on same date or same room");
}
set_error_handler('exceptions_error_handler');

try{
      $sql = "INSERT INTO INVIGILATES (room_no,teacher_id,exam_date) VALUES ('$room_no','$teacher_id','$exam_date')";
      $parse = oci_parse($conn,$sql);
      oci_execute($parse);
      $r = oci_commit($conn);
      $_SESSION['success']=' Record Successfully Added';
}
catch(Exception $e)
{
      $_SESSION['error']= $e->getMessage();
}
?>
      
<script type="text/javascript">
window.location="../view_invigilator.php";
</script>





