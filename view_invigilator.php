
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');

if(isset($_GET['room_no']) && isset($_GET['teacher_id']) && isset($_GET['exam_date']))
{ ?>
<div class="popup popup--icon -question js_question-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Sure
    </h1>
    <p>Are You Sure To Delete This Record?</p>
    <p>
      <a href="del_invigilator.php?room_no=<?php echo $_GET['room_no']; ?>&teacher_id=<?php echo $_GET['teacher_id']; ?>&exam_date=<?php echo $_GET['exam_date']; ?>" class="button button--success" data-for="js_success-popup">Yes</a>
      <a href="view_invigilator.php" class="button button--error" data-for="js_success-popup">No</a>
    </p>
  </div>
</div>
<?php } ?>


        <div class="page-wrapper">
            
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary"> View Invigilator</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">View Invigilator</li>
                    </ol>
                </div>
            </div>
            
            <div class="container-fluid">
               
                 <div class="card">
                            <div class="card-body">
                            <a href="add_invigilator.php"><button class="btn btn-primary">Add Invigilator</button></a>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Room No</th>
                                                <th>Teacher</th>
                                                <th>Date</th>
                                                <th>Action</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php 
                                    include 'connect.php';
                                  $sql1 = "SELECT INVIGILATES.TEACHER_ID,ROOM_NO,EXAM_DATE,TEACHER_NAME FROM  INVIGILATES join TEACHER on TEACHER.TEACHER_ID=INVIGILATES.TEACHER_ID";
                                  $parse = oci_parse($conn,$sql1);
                                  oci_execute($parse);
                                   
                                   while($row=oci_fetch_array($parse,OCI_ASSOC)) { 
                                      ?>
                                            <tr>
                                                <td><?php echo $row['ROOM_NO']; ?></td>
                                                <td><?php echo $row['TEACHER_NAME']; ?></td>
                                                <td><?php echo $row['EXAM_DATE']; ?></td>
                                                <td>
                                                <a href="view_invigilator.php?room_no=<?=$row['ROOM_NO'];?>&teacher_id=<?=$row['TEACHER_ID'];?>&exam_date=<?=$row['EXAM_DATE'];?>"><button type="button" class="btn btn-xs btn-danger" ><i class="fa fa-trash"></i></button></a>
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