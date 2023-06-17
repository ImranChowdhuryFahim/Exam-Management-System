<?php include('head.php');?>
<?php include('header1.php');?>

<?php include('stud_sidebar.php');?>


        <div class="page-wrapper">
            
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary"> View Marks Obtained</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">View Marks Obtained</li>
                    </ol>
                </div>
            </div>
            
            <div class="container-fluid">
               
                 <div class="card">
                            <div class="card-body">
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Course Code</th>
                                                <th>Section A</th>
                                                <th>Section B</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php 
                                    include 'connect.php';
                                  $sql1 = "SELECT STUDENT_ID,COURSE_CODE,CASE when SECTION_A is null then -1 Else SECTION_A END as SECTION_A,
                                  CASE when SECTION_B is null then -1 Else SECTION_B END as SECTION_B from MARKS_OBTAINED where student_id='" . $_SESSION["id"] . "'";
                                  $parse = oci_parse($conn,$sql1);
                                  oci_execute($parse);
                                   
                                   while($row=oci_fetch_array($parse,OCI_ASSOC)) { 
                                      
                                      ?>
                                            <tr>
                                                <td><?php echo $row['COURSE_CODE']; ?></td>
                                                <td><?php echo $row['SECTION_A']!=-1?$row['SECTION_A']:'Not Assigned'; ?></td>
                                                <td><?php echo $row['SECTION_B']!=-1?$row['SECTION_B']:'Not Assigned'; ?></td>
                                               
                                            </tr>
                                          <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
               
                

<?php include('footer.php');?>
