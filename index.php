<?php include('head.php');?>
<?php include('header.php');?>

<?php include('sidebar.php');?>   
<?php
 $current_date = date('Y-m-d');
?>    
      
        <div class="page-wrapper">
            
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Dashboard</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
            
            <div class="container-fluid">
                
        
                      <div class="row">
                    <div class="col-md-4">
                        <div class="card bg-primary p-20">
                            <div class="media widget-ten">
                                <div class="media-left meida media-middle">
                                    <span><i class="ti-bag f-s-40"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <?php $sql="SELECT TOTALTEACHERS from dual";
                                $parse = oci_parse($conn,$sql);
                                oci_execute($parse);
                                $row=oci_fetch_array($parse,OCI_ASSOC);
                                $count = oci_num_rows($parse);
                                ?> 
                                    <h2 class="color-white"><?php echo $row['TOTALTEACHERS'];?></h2>
                                    <p class="m-b-0">Total Teachers</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-pink p-20">
                            <div class="media widget-ten">
                                <div class="media-left meida media-middle">
                                    <span><i class="ti-comment f-s-40"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                <?php $sql="SELECT TOTALSTUDENTS from dual";
                                $parse = oci_parse($conn,$sql);
                                oci_execute($parse);
                                $row=oci_fetch_array($parse,OCI_ASSOC);?>
                                <h2 class="color-white"><?php echo $row['TOTALSTUDENTS'];?></h2>
                                    <p class="m-b-0">Total Students</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-danger p-20">
                            <div class="media widget-ten">
                                <div class="media-left meida media-middle">
                                    <span><i class="ti-vector f-s-40"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <?php $sql="SELECT TOTALCOURSES from dual";
                                $parse = oci_parse($conn,$sql);
                                oci_execute($parse);
                                $row=oci_fetch_array($parse,OCI_ASSOC);?>
                                <h2 class="color-white"><?php echo $row['TOTALCOURSES'];?></h2>
                                    <p class="m-b-0">Total Courses</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-warning p-20">
                            <div class="media widget-ten">
                                <div class="media-left meida media-middle">
                                    <span><i class="ti-location-pin f-s-40"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                     <?php $sql="SELECT TOTALROOMS from dual";
                                $parse = oci_parse($conn,$sql);
                                oci_execute($parse);
                                $row=oci_fetch_array($parse,OCI_ASSOC);?> 
                                    <h2 class="color-white"><?php echo $row['TOTALROOMS'];?></h2>
                                    <p class="m-b-0">Total Rooms</p>
                                </div>
                            </div>
                        </div>
                    </div>

                
            </div>
            
            <?php include('footer.php');?>