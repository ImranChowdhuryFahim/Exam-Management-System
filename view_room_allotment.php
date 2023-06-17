
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>



        <div class="page-wrapper">
           
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary"> View Room Allotment</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">View Room Allotment</li>
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
                                                <th>Exam Date</th> 
                                                <th>Room No</th>
                                                <th>Actions</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php 
                                    include 'connect.php';
                                    
                                  $sql1 = "SELECT student_id,course_code,exam_date,room_no,Case when room_no is null then 'Not Assigned' Else room_no End as room_no
                                  FROM  attendance";
                                  $parse = oci_parse($conn,$sql1);
                                  oci_execute($parse);

                                   while($row=oci_fetch_array($parse,OCI_ASSOC)) { 
                                
                              
                                      ?>
                                            <tr>
                                                <td><?php echo $row['STUDENT_ID']; ?></td>
                                                <td><?php echo $row['COURSE_CODE']; ?></td>
                                                <td><?php echo $row['EXAM_DATE']; ?></td>
                                                <td><?php echo $row['ROOM_NO']; ?></td>

                                                <td> 
                                                <a href="edit_room_allotment.php?student_id=<?=$row['STUDENT_ID'];?>&course_code=<?=$row['COURSE_CODE'];?>&exam_date=<?=$row['EXAM_DATE'];?>"><button type="button" class="btn btn-xs btn-primary" ><i class="fa fa-plus-square"></i></button></a> 
                                                
                                               
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