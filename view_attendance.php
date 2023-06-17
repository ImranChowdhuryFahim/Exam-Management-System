<?php include('head.php');?>
<?php include('header2.php');?>

<?php include('teacher_sidebar.php');?>   


        <div class="page-wrapper">
            
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary"> View Attendance</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">View Attendance</li>
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
                                                <th>Date</th>
                                                <th>Room No</th>
                                                <th>Student Id</th>
                                                <th>Course Code</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php 
                                    include 'connect.php';

                                 
                                  $sql1 = "SELECT STUDENT_ID,COURSE_CODE,CASE when ROOM_NO is null then 'Not Assigned' Else ROOM_NO END as room_no,
                                  CASE when STATUS is null then 'Not Assigned' Else STATUS END as STATUS,EXAM_DATE from ATTENDANCE where ROOM_NO in (select room_no from invigilates where teacher_id='" . $_SESSION['id'] . "')";

                                  $parse = oci_parse($conn,$sql1);
                                  oci_execute($parse);
                                   
                                   while($row=oci_fetch_array($parse,OCI_ASSOC)) { 
                                      ?>
                                            <tr>
                                                <td><?php echo $row['EXAM_DATE']; ?></td>
                                                <td><?php echo $row['ROOM_NO']; ?></td>
                                                <td><?php echo $row['STUDENT_ID']; ?></td>
                                                <td><?php echo $row['COURSE_CODE']; ?></td>
                                                <td><?php echo $row['STATUS']?></td>
                                                 <td>
                                                 
                                                    <a href="./pages/present.php?student_id=<?=$row['STUDENT_ID'];?>&course_code=<?=$row['COURSE_CODE'];?>&room_no=<?=$row['ROOM_NO'];?>&exam_date=<?=$row['EXAM_DATE'];?>"><button type="button" class="btn btn-xs btn-primary" >Present</button></a>
                                               
                                               
                                                    <a href="./pages/absent.php?student_id=<?=$row['STUDENT_ID'];?>&course_code=<?=$row['COURSE_CODE'];?>&room_no=<?=$row['ROOM_NO'];?>&exam_date=<?=$row['EXAM_DATE'];?>"><button type="button" class="btn btn-xs btn-danger" >Absent</button></a>
                                              
                                                </td>
                                            </tr>
                                          <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
               
                

<?php include('footer.php');?>
<link rel="stylesheet" href="popup_style.css">
<?php if(!empty($_SESSION['success'])) {  ?>
<div class="popup popup--icon -success js_success-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Success 
    </h1>
    <p><?php echo $_SESSION['success']; ?></p>
    <p>
      <button class="button button--success" data-for="js_success-popup">Close</button>
    </p>
  </div>
</div>
<?php unset($_SESSION["success"]);  
} ?>
<?php if(!empty($_SESSION['error'])) {  echo "aschi";  ?>
 
<div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Error 
    </h1>
    <p><?php echo $_SESSION['error']; ?></p>
    <p>
      <button class="button button--error" data-for="js_error-popup">Close</button>
    </p>
  </div>
</div>
<?php unset($_SESSION["error"]);  } ?>
    <script>
      var addButtonTrigger = function addButtonTrigger(el) {
  el.addEventListener('click', function () {
    var popupEl = document.querySelector('.' + el.dataset.for);
    popupEl.classList.toggle('popup--visible');
  });
};

Array.from(document.querySelectorAll('button[data-for]')).
forEach(addButtonTrigger);
    </script>