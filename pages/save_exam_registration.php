
<?php
include('../connect.php');
session_start();
extract($_POST);
$arr = explode("  --  ",$course_code);
$course_code = $arr[0];
$exam_date = $arr[1];
$email = $_SESSION["email"];
$student_id = $_SESSION["id"];

function exceptions_error_handler($severity, $message, $filename, $lineno) {
      throw new Exception("Already has an exam on same date or already has the course");
}
set_error_handler('exceptions_error_handler');

try{
      $sql = "BEGIN INSERT INTO ATTENDANCE (course_code,student_id,exam_date) VALUES ('$course_code','$student_id','$exam_date');
      INSERT INTO MARKS_OBTAINED (course_code,student_id) VALUES ('$course_code','$student_id'); END;";
  $parse = oci_parse($conn,$sql);
  oci_execute($parse); 
  oci_commit($conn); 
  $_SESSION['success']=' Record Successfully Added';
}
catch(Exception $e)
{
    echo "\nException Caught:\n\n";
    $_SESSION['error']= $e->getMessage();
}
?>
<script type="text/javascript">
window.location="../student_panel.php";
</script>





