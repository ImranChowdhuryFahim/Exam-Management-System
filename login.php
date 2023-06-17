<?php session_start();?>
<?php include('head.php');?>
<link rel="stylesheet" href="popup_style.css">

   <?php
  include('connect.php');
if(isset($_POST['btn_login']))
{
$email = $_POST['email'];

// $pass = $_POST['password'];

$passw = hash('sha256', $_POST['password']);

function createSalt()
{
    return '2123293dsj2hu2nikhiljdsd';
}
$salt = createSalt();
$pass = hash('sha256', $salt . $passw);


$type = $_POST['user_type'];


 $sql = "SELECT * FROM login where email= '" . $email. "' and password= '" . $pass . "' and user_type='" . $type . "'";
    $parse = oci_parse($conn,$sql);
    $r = oci_execute($parse);
    $row=oci_fetch_array($parse,OCI_ASSOC);
    
     $_SESSION["id"] = $row['ID'];
     $_SESSION["email"] = $row['EMAIL'];
     $_SESSION["password"] = $row['PASSWORD'];
     $_SESSION["user_type"] = $row['USER_TYPE'];
     $count=oci_num_rows($parse);


     if($_SESSION["user_type"]=='Student' || $_SESSION["user_type"]=='Teacher')
     {
        if($_SESSION["user_type"]=='Student') $sql = "SELECT * FROM student where student_email= '" . $email. "'";
        else if($_SESSION["user_type"]=='Teacher') $sql = "SELECT * FROM teacher where teacher_email= '" . $email. "'";
        $parse = oci_parse($conn,$sql);
        $r = oci_execute($parse);
        $row=oci_fetch_array($parse,OCI_ASSOC);

        if($_SESSION["user_type"]=='Student') {
            $_SESSION["id"] = $row['STUDENT_ID'];
            $_SESSION["name"] = $row['STUDENT_NAME'];
        } 
        else if($_SESSION["user_type"]=='Teacher'){
            $_SESSION["id"] = $row['TEACHER_ID'];
            $_SESSION["name"] = $row['TEACHER_NAME'];
        } 
     }
    
    //  echo implode(",",$row);
     oci_close($conn);
     if($count==1 && isset($_SESSION["email"]) && isset($_SESSION["password"]) && isset($_SESSION["id"]) && isset($_SESSION["user_type"]) ) {
    {       
        ?>
         <div class="popup popup--icon -success js_success-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Success 
    </h1>
    <p>Login Successfully</p>
    <p>
    
     <?php 
      if($_SESSION["user_type"]=="Admin") echo "<script>setTimeout(\"location.href = 'index.php';\",1500);</script>";
      else if($_SESSION["user_type"]=="Student")echo "<script>setTimeout(\"location.href = 'student_panel.php';\",1500);</script>";
      else echo "<script>setTimeout(\"location.href = 'teacher_panel.php';\",1500);</script>";
      ?>
    </p>
  </div>
</div>
  
     <?php
    }
}
else {?>
     <div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Error 
    </h1>
    <p>Invalid Email or Password</p>
    <p>
      <a href="login.php"><button class="button button--error" data-for="js_error-popup">Close</button></a>
    </p>
  </div>
</div>
       
        <?php
       
         }
    
    }
?>

    <div id="main-wrapper">
        <div class="unix-login">
             
            <div class="container-fluid"  style="background-image: url('Asset/exam.png ">
                <div class="row justify-content-center" >
                    <div class="col-lg-4">
                        <div class="login-content card">
                            <div class="login-form">
                                <center><h1 style="color:red;font-weight:bold">Halltracker</h1><p style="color:blue">keeping exams on track</p></center><br>
                                <form method="POST">
                                    <div class="form-group">
                                        <label>Email address</label>
                                        <input type="email" name="email" class="form-control" placeholder="Email" required="">
                                    </div>

                                    <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">User Type</label>
                                                <div class="col-sm-9">
                                                   <select name="user_type" id="user_type" class="form-control" required="">
                                                    <option value=" ">--Select Type--</option>
                                                     <option value="Admin">Admin</option>
                                                      <option value="Teacher">Teacher</option>
                                                      <option value="Student">Student</option>
                                                   </select>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="Password" required="">
                                    </div>
                                    <button type="submit" name="btn_login" class="btn btn-primary btn-flat m-b-30 m-t-30">Sign in</button>
                                  
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
	
    
    <script src="js/lib/jquery/jquery.min.js"></script>

    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>

    <script src="js/jquery.slimscroll.js"></script>

    <script src="js/sidebarmenu.js"></script>

    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>

    <script src="js/custom.min.js"></script>

</body>

</html>