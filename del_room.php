<?php
include 'connect.php';
session_start();

$sql = "DELETE FROM room WHERE room_no='".$_GET["room_no"]."'";
$parse = oci_parse($conn, $sql);
oci_execute($parse);
$r = oci_commit($conn);
 $_SESSION['success']=' Record Successfully Deleted';
?>
<script>

window.location = "view_room.php";
</script>

