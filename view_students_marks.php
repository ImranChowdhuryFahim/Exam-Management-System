<?php include('head.php');?>
<?php include('header2.php');?>

<?php include('teacher_sidebar.php');?>   


        <div class="page-wrapper">
            
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary"> View Marks</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">View Marks</li>
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
                                                <th>Student Id</th>
                                                <th>Course Code</th>
                                                <th>Section A</th>
                                                <th>Section B</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php 
                                    include 'connect.php';

                                  $sql = "SELECT course_code,section ";
                                  $sql1 = "SELECT STUDENT_ID,COURSE_CODE,CASE when SECTION_A is null then -1 Else SECTION_A END as SECTION_A,
                                  CASE when SECTION_B is null then -1 Else SECTION_B END as SECTION_B from MARKS_OBTAINED where COURSE_CODE in (select course_code from courses_responsibility where teacher_id='" . $_SESSION['id'] . "')";

                                  $parse = oci_parse($conn,$sql1);
                                  oci_execute($parse);
                                   
                                   while($row=oci_fetch_array($parse,OCI_ASSOC)) { 
                                      $a = "SELECT count(section) as A from courses_responsibility where course_code='" . $row['COURSE_CODE'] . "' and section='A'";
                                      $p1 = oci_parse($conn,$a);
                                      oci_execute($p1);
                                      $r1= oci_fetch_array($p1,OCI_ASSOC);
                                      $b = "SELECT count(section) as B from courses_responsibility where course_code='" . $row['COURSE_CODE'] . "' and section='B'";
                                      $p2 = oci_parse($conn,$b);
                                      oci_execute($p2);
                                      $r2= oci_fetch_array($p2,OCI_ASSOC);
                                      ?>
                                            <tr>
                                                <td><?php echo $row['STUDENT_ID']; ?></td>
                                                <td><?php echo $row['COURSE_CODE']; ?></td>
                                                <td><?php echo $row['SECTION_A']!=-1?$row['SECTION_A']:'Not Assigned'; ?></td>
                                                <td><?php echo $row['SECTION_B']!=-1?$row['SECTION_B']:'Not Assigned'; ?></td>
                                                 <td>
                                                 <?php if(isset($r1['A'])){  if($r1['A']==1){ ?> 
                                                    <a href="assign_marks_a.php?student_id=<?=$row['STUDENT_ID'];?>&course_code=<?=$row['COURSE_CODE'];?>&section='A'"><button type="button" class="btn btn-xs btn-primary" >A</button></a>
                                              <?php } } ?>   
                                              <?php if(isset($r2['B'])){  if($r2['B']==1){ ?> 
                                                    <a href="assign_marks_b.php?student_id=<?=$row['STUDENT_ID'];?>&course_code=<?=$row['COURSE_CODE'];?>&section='B'"><button type="button" class="btn btn-xs btn-primary" >B</button></a>
                                              <?php } } ?> 
                                                </td>
                                            </tr>
                                          <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
               
                

<?php include('footer.php');?>
