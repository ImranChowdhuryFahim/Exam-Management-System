<?php include('head.php');?>
<?php include('header1.php');?>

<?php include('stud_sidebar.php');

if(isset($_GET['course_code']) && isset($_GET['exam_date']))
{ ?>
<div class="popup popup--icon -question js_question-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Sure
    </h1>
    <p>Are You Sure To Delete This Record?</p>
    <p>
      <a href="del_exam_registration.php?course_code=<?php echo $_GET['course_code']; ?>&exam_date=<?php echo $_GET['exam_date']; ?>" class="button button--success" data-for="js_success-popup">Yes</a>
      <a href="student_panel.php" class="button button--error" data-for="js_success-popup">No</a>
    </p>
  </div>
</div>
<?php } ?>

      
        <div class="page-wrapper">
            
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Dashboard</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Student ID: <?php echo $_SESSION['id'] ?></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
            
            <div class="container-fluid">                    
               <div class="card">
                            <div class="card-body">
                            <a href="./pages/download_admit.php"><button class="btn btn-primary">Download Admit</button></a>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Exam Name</th>
                                                <th>Exam Date</th>
                                                <th>Time</th> 
                                                <th>Room Name</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php 
                                     include 'connect.php';
                                     $sql1 = "SELECT exam_scheduling.course_code,to_char(exam_scheduling.start_time,'HH.MI AM') as start_time,
                                     to_char(exam_scheduling.end_time,'HH.MI AM') as end_time,exam_scheduling.exam_date,
                                      CASE when attendance.room_no is null THEN 'Not Assigned' ELSE attendance.room_no END as room_no FROM  attendance
                                       join exam_scheduling on attendance.course_code=exam_scheduling.course_code and 
                                       attendance.exam_date=exam_scheduling.exam_date  WHERE attendance.student_id='".$_SESSION["id"]."'";
	                                $parse = oci_parse($conn,$sql1);
	                                oci_execute($parse);
                                     
                                    while($row=oci_fetch_array($parse,OCI_ASSOC)) {
                                      ?>
                                            <tr>
                                                <td><?php echo $row['COURSE_CODE']; ?></td>
                                                <td><?php echo $row['EXAM_DATE']; ?></td>
                                                <td><?php echo $row['START_TIME'].'-'.$row['END_TIME']; ?></td>
                                                <td><?php echo isset($row['ROOM_NO'])?$row['ROOM_NO']:''; ?></td>
                                                <td>
                                                <a href="student_panel.php?course_code=<?=$row['COURSE_CODE'];?>&exam_date=<?=$row['EXAM_DATE'];?>"><button type="button" class="btn btn-xs btn-danger" ><i class="fa fa-trash"></i></button></a>
                                                </td>
                                            </tr>
                                          <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
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
<?php if(!empty($_SESSION['error'])) {  ?>
 
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