
<?php include('head.php');?>

<?php include('header.php');?>
<?php include('sidebar.php');?>

 <?php
 include('connect.php');
if(isset($_POST["btn_update"]))
{
    extract($_POST);
    
      $q1="UPDATE room SET capacity='" . $capacity . "',location='" . $location . "' WHERE room_no='".$_GET['room_no']."'";
      $parse = oci_parse($conn,$q1);
      oci_execute($parse);
      $r = oci_commit($conn);
 
    if ($r) {
      $_SESSION['success']=' Record Successfully Updated';
     ?>
<script type="text/javascript">
window.location="view_room.php";
</script>
<?php
} else {
      $_SESSION['error']='Something Went Wrong';
?>
<script type="text/javascript">
window.location="view_room.php";
</script>
<?php
}

}
?>

<?php
$que="SELECT * from room WHERE room_no='".$_GET["room_no"]."'";
$parse = oci_parse($conn,$que);
oci_execute($parse);

while($row=oci_fetch_array($parse,OCI_ASSOC))
{
   
    extract($row);
$room_no = $row['ROOM_NO'];
$capacity = $row['CAPACITY'];
$location = $row['LOCATION'];
}

?> 


   


 
        <div class="page-wrapper">
         
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Room Management</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Room Management</li>
                    </ol>
                </div>
            </div>
         
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-lg-8" style="    margin-left: 10%;">
                        <div class="card">
                            <div class="card-title">
                               
                            </div>
                            <div class="card-body">
                                <div class="input-states">
                                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" name="subjectform">

                                
                                    <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Room No</label>
                                                <div class="col-sm-9">
                                                  <input type="text" name="room_no" class="form-control" placeholder="Room No"  value="<?php echo $room_no; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Capacity</label>
                                                <div class="col-sm-9">
                                                  <input type="number" min="0" name="capacity" class="form-control" placeholder="Capacity"  value="<?php echo $capacity; ?>" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label">Location</label>
                                                <div class="col-sm-9">
                                                  <input type="text"  name="location" class="form-control" value="<?php echo $location; ?>" placeholder=" Location" required="">
                                                </div>
                                            </div>
                                        </div>

                                       
                                        <button type="submit" name="btn_update" class="btn btn-primary btn-flat m-b-30 m-t-30">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
   
<?php include('footer.php');?>

