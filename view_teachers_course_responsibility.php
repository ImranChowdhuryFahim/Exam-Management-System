<?php include('head.php');?>
<?php include('header2.php');?>

<?php include('teacher_sidebar.php');?>   



        <div class="page-wrapper">
           
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary"> View Course Responsibility</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">View Courses Responsibility</li>
                    </ol>
                </div>
            </div>
           
            <div class="container-fluid">
                
                 <div class="card">
                            <div class="card-body">
                              <?php if(isset($user_type)){  if($user_type=='Admin'){ ?> 
                            <a href="add_course_responsibility.php"><button class="btn btn-primary">Add Courses Responsibility</button></a>
                          <?php } } ?>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Course Code</th>
                                                <th>Section</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php 
                                    include 'connect.php';
                                    
                                  $sql = "SELECT COURSE_CODE,TEACHER_ID,SECTION  FROM  courses_responsibility where teacher_id='" . $_SESSION['id'] . "'";
                                  $parse = oci_parse($conn,$sql);
                                  oci_execute($parse);
                                   while($row=oci_fetch_array($parse,OCI_ASSOC)) { 
                                
                                 
                                      ?>
                                            <tr>
                                                <td><?php echo $row['COURSE_CODE']; ?></td>
                                                <td><?php echo $row['SECTION']; ?></td>
                                                
                
                                            </tr>
                                          <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
               
               
<?php include('footer.php');?>
