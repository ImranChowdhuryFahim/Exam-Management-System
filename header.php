<?php session_start();
 include('connect.php');
    if(!isset($_SESSION["email"])){
    ?>
    <script>
    window.location="login.php";
    </script>
    <?php
    
} else { 

 
    ?>
   
    <div id="main-wrapper">
        
        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
              
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">
                     <h1 style = "color:yellow"> Halltracker </h1> <p style="color:yellow;margin-bottom: 25px;"> keeping exams on track </p>
                    </a>
                </div>
                
                <div class="navbar-collapse">
                    
                    <ul class="navbar-nav mr-auto mt-md-0">
                        
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted  " href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted  " href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        
                    </ul>
                    
                    <ul class="navbar-nav my-lg-0">

                      
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="Asset/Profile/blank_avatar.png" alt="user" class="profile-pic"/>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">                                  
                                    <li>Admin</li>
                                    <li><?php echo $_SESSION['email'] ?>  </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
       
        <?php } ?>