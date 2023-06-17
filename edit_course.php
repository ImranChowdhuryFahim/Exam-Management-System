
<?php include('head.php');?>

<?php include('header.php');?>
<?php include('sidebar.php');?>

 <?php
 include('connect.php');
if(isset($_POST["btn_update"]))
{
    extract($_POST);
    
      $q1="UPDATE courses SET course_name='$course_name',course_title='" . $course_title . "' WHERE course_code='".$_GET['course_code']."'";
      $parse = oci_parse($conn,$q1);
      oci_execute($parse);
      $r = oci_commit($conn);
 
    if ($r) {
      $_SESSION['success']=' Record Successfully Updated';
     ?>
<script type="text/javascript">
window.location="view_course.php";
</script>
<?php
} else {
      $_SESSION['error']='Something Went Wrong';
?>
<script type="text/javascript">
window.location="view_course.php";
</script>
<?php
}

}
?>

<?php
$que="SELECT * from courses WHERE course_code='".$_GET["course_code"]."'";
$parse = oci_parse($conn,$que);
oci_execute($parse);
while($row=oci_fetch_array($parse,OCI_ASSOC))
{
   
    extract($row);
$course_code = $row['COURSE_CODE'];
$course_name = $row['COURSE_NAME'];
$course_title = $row['COURSE_TITLE'];

}

?> 


   


 
        <div class="page-wrapper">
         
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Course Management</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Add Course Management</li>
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
                                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" name="courseform">
                                    
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Course Code</label>
                                                <div class="col-sm-9">
                                                  <input type="text" name="course_code" class="form-control" placeholder="Course Name" id="event" onkeydown="return alphaOnly(event);" value="<?php echo $course_code; ?>" required="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Course Title</label>
                                                <div class="col-sm-9">
                                                  <input type="text" name="course_title" class="form-control" placeholder="Course Name" id="event" onkeydown="return alphaOnly(event);" value="<?php echo $course_title; ?>" required="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Course Name</label>
                                                <div class="col-sm-9">
                                                  <input type="text" name="course_name" class="form-control" placeholder="Course Name" id="event" onkeydown="return alphaOnly(event);" value="<?php echo $course_name; ?>" required="">
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

