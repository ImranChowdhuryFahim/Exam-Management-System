
<?php include('head.php');?>

<?php include('header.php');?>
<?php include('sidebar.php');?>

 <?php
 include('connect.php');
if(isset($_POST["btn_update"]))
{

      $q1="UPDATE attendance SET room_no='" . $_POST['room_no'] . "' WHERE student_id='".$_GET['student_id']."' and course_code='".$_GET['course_code']."' and exam_date='".$_GET['exam_date']."'";
      $parse = oci_parse($conn,$q1);
      oci_execute($parse);
      $r = oci_commit($conn);
 
    if ($r) {
      $_SESSION['success']=' Record Successfully Updated';
     ?>
<script type="text/javascript">
window.location="view_room_allotment.php";
</script>
<?php
} else {
      $_SESSION['error']='Something Went Wrong';
?>
<script type="text/javascript">
window.location="view_room_allotment.php";
</script>
<?php
}

}
?>

<?php
$student_id = $_GET['student_id'];
$exam_date = $_GET['exam_date'];
$course_code = $_GET['course_code'];

?> 


   


 
        <div class="page-wrapper">
         
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Edit Room Allotment</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Edit Room Allotment</li>
                    </ol>
                </div>
            </div>
         
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-lg-8" style="    margin-left: 10%;">
                        <div class="card">
                            <div class="card-title">
                               
                            </div>
                            <div class="card-body">
                                <div class="input-states">
                                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" name="subjectform">

                                
                                    <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Student Id</label>
                                                <div class="col-sm-9">
                                                  <input type="text" name="student_id" class="form-control" placeholder="Room No"  value="<?php echo $student_id; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Course Code</label>
                                                <div class="col-sm-9">
                                                  <input type="number" min="0" name="course_code" class="form-control" placeholder="Capacity"  value="<?php echo $course_code; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Exam Date</label>
                                                <div class="col-sm-9">
                                                  <input type="text"  name="exam_date" class="form-control" value="<?php echo $exam_date; ?>" placeholder=" Location" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Room No</label>
                                                <div class="col-sm-9">
                                                   <select name="room_no" id="room_no" class="form-control" required="">
                                                    <option value=" ">--Room No--</option>
                                                     <?php  
                          $sql2 = "SELECT room_no FROM room where capacity>(select count(room_no) from attendance where exam_date='" . $exam_date . "')";
                          $parse = oci_parse($conn,$sql2); 
                          oci_execute($parse);
                          while($row=oci_fetch_array($parse,OCI_ASSOC)){
                        ?>
                        <option value ="<?php echo $row['ROOM_NO'];?>"><?php echo $row['ROOM_NO'];?> </option>
                      <?php } ?>
                                                   </select>
                                                </div> 
                                            </div>
                                        </div>

                                       
                                        <button type="submit" name="btn_update" class="btn btn-primary btn-flat m-b-30 m-t-30">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
   
<?php include('footer.php');?>

