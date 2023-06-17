<?php include('head.php');?>
<?php include('header2.php');?>

<?php include('teacher_sidebar.php');?>   

 <?php
 include('connect.php');
if(isset($_POST["btn_update"]))
{


    extract($_POST);   



    $q1="UPDATE marks_obtained SET section_b='" . $marks . "' WHERE course_code='".$course_code."' and student_id='".$student_id."'";

      $parse = oci_parse($conn,$q1);
      oci_execute($parse);
      $r = oci_commit($conn);
 
    if ($r) {
      $_SESSION['success']=' Record Successfully Updated';
     ?>
<script type="text/javascript">
window.location="view_students_marks.php";
</script>
<?php
} else {
      $_SESSION['error']='Something Went Wrong';
?>
<script type="text/javascript">
window.location="view_students_marks.php";
</script>
<?php
}

}
?>

<?php

$course_code = $_GET['course_code'];
$student_id = $_GET['student_id'];
$section = $_GET['section'];


?> 


   


 
        <div class="page-wrapper">
         
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Assign Marks</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Assign Marks</li>
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
                                                <label class="col-sm-3 control-label">Student Id</label>
                                                <div class="col-sm-9">
                                                  <input type="text" name="student_id" class="form-control" placeholder="Student Id"  value="<?php echo $student_id; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Course Code</label>
                                                <div class="col-sm-9">
                                                  <input type="text" name="course_code" class="form-control" placeholder="Course Code" value="<?php echo $course_code; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Section</label>
                                                <div class="col-sm-9">
                                                  <input type="text" name="section" class="form-control" placeholder="Section" value="<?php echo $section; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Marks</label>
                                                <div class="col-sm-9">
                                                  <input type="number" name="marks" min="0" class="form-control" placeholder="Marks" required>
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

