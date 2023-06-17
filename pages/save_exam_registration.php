
<?php
include('../connect.php');
session_start();
extract($_POST);
$arr = explode("  --  ",$course_code);
$course_code = $arr[0];
$exam_date = $arr[1];
$email = $_SESSION["email"];
$student_id = $_SESSION["id"];

$sql = "BEGIN INSERT INTO ATTENDANCE (course_code,student_id,exam_date) VALUES ('$course_code','$student_id','$exam_date');
    INSERT INTO MARKS_OBTAINED (course_code,student_id) VALUES ('$course_code','$student_id'); END;";
$parse = oci_parse($conn,$sql);
oci_execute($parse);
$r = oci_commit($conn);
if ($r) {
      $_SESSION['success']=' Record Successfully Added';
     ?>
<script type="text/javascript">
window.location="../student_panel.php";
</script>
<?php
} else {
      $_SESSION['error']='Something Went Wrong';
?>
<script type="text/javascript">
window.location="../student_panel.php";
</script>
<?php } ?>




