<?php include('head.php');?>
<?php include('header2.php');?>

<?php include('teacher_sidebar.php');?>

<?php
include 'connect.php';

if(isset($_POST['submit'])!=""){
  $name=$_FILES['file']['name'];
  $size=$_FILES['file']['size'];
  $type=$_FILES['file']['type'];
  $temp=$_FILES['file']['tmp_name'];

  $fname = date("YmdHis").'_'.$name;
  $move =  move_uploaded_file($temp,"upload/".$fname);
 if($move){
    $sql = "insert into questions(question_file)values( question_file('".$name."','".$fname."','".$_SESSION['name']."') )";
    $parse = oci_parse($conn,$sql);
    $r = oci_execute($parse);
    oci_commit($conn);
 }
}
?>

        <div class="page-wrapper">
           
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary"> View Questions</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">View Questions</li>
                    </ol>
                </div>
            </div>
           
            <div class="container-fluid">
                
                 <div class="card">	
			        <form enctype="multipart/form-data" action="" name="form" method="post">
				    Select Question
					<input type="file" name="file" id="file" /></td>
					<input type="submit" name="submit" id="submit" value="Submit" />
			        </form>
                            <div class="card-body"> 
                                
                                <div class="table-responsive m-t-40">
                                    
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Questions</th>
                                                <th>Uploaded By</th>
                                                <th>Action</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                    include 'connect.php';
                                    $curs = oci_new_cursor($conn);
                                    $stid = oci_parse($conn, "begin myproc(:cursbv); end;");
                                    oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
                                    oci_execute($stid);
                                    
                                    oci_execute($curs); 
                                   
                                  while(($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
                                      ?>
                                            <tr>
                                                <td> &nbsp;<?php echo $row['FNAME'];?> </td>
                                                <td><?php  echo $row['UPLOADED_BY']; ?></td>
                                                <td> 
                                                <a href="download.php?filename=<?php echo $row['FNAME'];?>&f=<?php echo $row['NAME'] ?>"><button type="button" class="btn btn-xs btn-primary" >Download</button></a>
                                                </td>
                                            </tr>
                                          <?php }
                                          oci_free_statement($stid);
                                          oci_free_statement($curs);
                                          oci_close($conn);
                                          
                                          ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
               
               
<?php include('footer.php');?>
<script src="js/lib/datatables/datatables-init.js"></script>


