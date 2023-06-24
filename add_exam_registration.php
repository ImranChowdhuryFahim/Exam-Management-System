<?php include('head.php');?>
<?php include('header1.php');?>

<?php include('stud_sidebar.php');?>   

        <div class="page-wrapper">
           
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Exam Registraion Management</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Student ID: <?php echo $_SESSION['id'] ?></li>
                        <li class="breadcrumb-item active">Exam Registraion Management</li>
                    </ol>
                </div>
            </div>
            
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-lg-8" style="margin-left: 10%;">
                        <div class="card">
                            <div class="card-body">
                                <div class="input-states">
                                    <form class="form-horizontal" method="POST" action="./pages/save_exam_registration.php" name="userform" enctype="multipart/form-data">



                                    <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Exam</label>
                                                <div class="col-sm-9">
                                                   <select name="course_code" id="course_code" class="form-control" required="">
                                                    <option value=" ">--Select Exam--</option>
                                                     <?php  
                          $sql2 = "SELECT * FROM EXAM_SCHEDULING";
                          $parse = oci_parse($conn,$sql2); 
                          oci_execute($parse);
                          while($row=oci_fetch_array($parse,OCI_ASSOC)){
                        ?>
                        <option value ="<?php echo "".$row['COURSE_CODE']."  --  ".$row['EXAM_DATE']."";?>"><?php echo " ".$row['COURSE_CODE']."  --  ".$row['EXAM_DATE']."";?> </option>
                      <?php } ?>
                                                   </select>
                                                </div> 
                                            </div>
                                        </div>
                                        


                                        <button type="submit" name="btn_save" class="btn btn-primary btn-flat m-b-30 m-t-30">Register</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
                
        
<?php include('footer.php');?>
