
<?php
include('../connect.php');
session_start();
$passw = hash('sha256', $_POST['password']);

function createSalt()
{
    return '2123293dsj2hu2nikhiljdsd';
}
$salt = createSalt();
$pass = hash('sha256', $salt . $passw);
$_POST['password'] = $pass;
$user_type = "Teacher";

extract($_POST);
   $sql = "INSERT INTO teacher (teacher_name, teacher_email, teacher_contact_no) VALUES ('" . $teacher_name . "', '" . $teacher_email . "', '" . $teacher_contact_no . "')";
   $parse = oci_parse($conn,$sql);
   $r = oci_execute($parse);
   $sql = "INSERT INTO login (email, password, user_type) VALUES ('" . $teacher_email . "', '" . $password . "', '" . $user_type . "')";
   $parse = oci_parse($conn,$sql);
   $r = oci_execute($parse);

   $r = oci_commit($conn);
   oci_close($conn);
 if ($r) {
      $_SESSION['success']=' Record Successfully Added';
     ?>
<script type="text/javascript">
window.location="../view_teacher.php";
</script>
<?php
} else {
      $_SESSION['error']='Something Went Wrong';
?>
<script type="text/javascript">
window.location="../view_teacher.php";
</script>
<?php } ?>