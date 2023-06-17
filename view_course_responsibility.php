
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');

if(isset($_GET['course_code']) && isset($_GET['teacher_id']))
{ ?>
<div class="popup popup--icon -question js_question-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Sure
    </h1>
    <p>Are You Sure To Delete This Record?</p>
    <p>
      <a href="del_course_responsibility.php?course_code=<?php echo $_GET['course_code']; ?>&teacher_id=<?php echo $_GET['teacher_id']; ?>" class="button button--success" data-for="js_success-popup">Yes</a>
      <a href="view_course_responsibility.php" class="button button--error" data-for="js_success-popup">No</a>
    </p>
  </div>
</div>
<?php } ?>



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
                                                <th>Teacher Id</th>
                                                <th>Section</th>
                                               
                                                <th>Action</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php 
                                    include 'connect.php';
                                    
                                  $sql = "SELECT COURSE_CODE,TEACHER_NAME,TEACHER.TEACHER_ID,SECTION  FROM  courses_responsibility join teacher on teacher.teacher_id = courses_responsibility.teacher_id";
                                  $parse = oci_parse($conn,$sql);
                                  oci_execute($parse);
                                   while($row=oci_fetch_array($parse,OCI_ASSOC)) { 
                                
                                 
                                      ?>
                                            <tr>
                                                <td><?php echo $row['COURSE_CODE']; ?></td>
                                                <td><?php echo $row['TEACHER_NAME']; ?></td>
                                                <td><?php echo $row['SECTION']; ?></td>
                                                
                                                <td>

            

            <?php if(isset($user_type)){  if($user_type == "Admin"){ ?> 
                                                <a href="view_course_responsibility.php?course_code=<?=$row['COURSE_CODE'];?>&teacher_id=<?=$row['TEACHER_ID'];?>"><button type="button" class="btn btn-xs btn-danger" ><i class="fa fa-trash"></i></button></a>
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