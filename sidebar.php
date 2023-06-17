 <?php 

             $user_type = $_SESSION['user_type'];

 ?>

 
        <div class="left-sidebar">
            
            <div class="scroll-sidebar">
                
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Home</li>
                        <li> <a href="index.php" aria-expanded="false"><i class="fa fa-window-maximize"></i>Dashboard</a>
                        </li>

                        <?php if(!isset($user_type)){  if($user_type=='Admin'){ ?> 
                         <!-- <li class="nav-label">Attendence</li> -->
                        <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-clock-o"></i><span class="hide-menu">Attendence Management</span></a>
                            <ul aria-expanded="false" class="collapse">
                            <?php if(isset($user_type)){  if($user_type=='Admin'){ ?> 
                                <li><a href="add_attendence.php">Add Attendence</a></li>
                            <?php } } ?>
                                <li><a href="view_attendence.php">View Attendence</a></li>
                               
                            </ul>
                        </li>
                    <?php } } ?>

                        <?php if(isset($user_type)){  if($user_type=='Admin'){ ?> 
                         <!-- <li class="nav-label">Teacher</li> -->
                        <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Teacher Management</span></a>
                            <ul aria-expanded="false" class="collapse">
                            <?php if(isset($user_type)){  if($user_type=='Admin'){ ?> 
                                <li><a href="add_teacher.php">Add Teacher</a></li>
                            <?php } } ?>
                                <li><a href="view_teacher.php">View Teacher</a></li>
                            </ul>
                        </li>
                    <?php } } ?> 

                         <?php if(isset($user_type)){  if($user_type=='Admin'){ ?> 
                         <!-- <li class="nav-label">Student</li> -->
                        <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Student Management</span></a>
                            <ul aria-expanded="false" class="collapse">
                            <?php if(isset($user_type)){  if($user_type=='Admin'){ ?> 
                                <li><a href="add_student.php">Add Student</a></li>
                            <?php } } ?>
                                <li><a href="view_student.php">View Student</a></li>
                            </ul>
                        </li>
                    <?php } } ?>

                         <?php if(isset($user_type)){  if($user_type=='Admin'){ ?> 
                         <!-- <li class="nav-label">Subject</li> -->
                        <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-newspaper-o"></i><span class="hide-menu">Course Management</span></a>
                            <ul aria-expanded="false" class="collapse">
                            <?php if(isset($user_type)){  if($user_type=='Admin'){ ?> 
                                <li><a href="add_course.php">Add Course</a></li>
                            <?php } } ?>
                                <li><a href="view_course.php">View Course</a></li>

                            <?php if(isset($user_type)){  if($user_type=='Admin'){ ?> 
                                <li><a href="add_course_responsibility.php">Add Course Responsibility</a></li>
                            <?php } } ?>
                                <li><a href="view_course_responsibility.php">View Course Responsibility</a></li>
                            </ul>
                        </li>
                    <?php } } ?>

                      

                    

                     <?php if(isset($user_type)){  if($user_type=='Admin'){ ?> 
                         <!-- <li class="nav-label">Class</li> -->
                        <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-home"></i><span class="hide-menu">Room Management</span></a>
                            <ul aria-expanded="false" class="collapse">
                            <?php if(isset($user_type)){ if($user_type=='Admin'){ ?> 
                                <li><a href="add_room.php">Add Room</a></li>
                            <?php } } ?>
                                <li><a href="view_room.php">View Room</a></li>
                            <?php if(isset($user_type)){  if($user_type=='Admin'){ ?> 
                                <li><a href="view_room_allotment.php">View Room Allotment</a></li>
                            <?php } } ?>
                            </ul>
                        </li>
                    <?php } } ?>

                    

                    <?php if(isset($user_type)){  if($user_type=='Admin'){ ?> 
                         <!-- <li class="nav-label">Class</li> -->
                        <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-graduation-cap"></i><span class="hide-menu">Exam Management</span></a>
                            <ul aria-expanded="false" class="collapse"> 
                               
                                <li><a href="add_exam.php">Add Exam</a></li>
                                <li><a href="view_exam.php">View Exam</a></li>
                                <?php if(isset($user_type)){  if($user_type=='Admin'){ ?> 
                                <li><a href="view_exam_request.php">View Exam Request</a></li>
                            <?php } } ?>
                                
                            </ul>
                        </li>
                    <?php } } ?>


                    <?php if(isset($user_type)){  if($user_type=='Admin'){ ?> 
                         <!-- <li class="nav-label">Class</li> -->
                        <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Invigilator Management</span></a>
                            <ul aria-expanded="false" class="collapse">
                            <?php if(isset($user_type)){ if($user_type=='Admin'){ ?> 
                                <li><a href="add_invigilator.php">Add Invigilator</a></li>
                            <?php } } ?>
                                <li><a href="view_invigilator.php">View Invigilator</a></li>
                            </ul>
                        </li>
                    <?php } } ?>
                   
                   
               

                    
                         
                   
                   
                     


    
                    </ul>   
                </nav>
                




            </div>
           
        </div>
        