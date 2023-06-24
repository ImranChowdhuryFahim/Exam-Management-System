<?php include('connect.php');
session_start();

$output= array();
$room_no = $_SESSION['room_no'];
$exam_date = $_SESSION['exam_date'];
$sql = "SELECT STUDENT_ID,COURSE_CODE,ROOM_NO,
CASE when STATUS is null then 'Not Assigned' Else STATUS END as STATUS,EXAM_DATE from ATTENDANCE where ROOM_NO='".$room_no."' and EXAM_DATE='".$exam_date."' ";
$parse = oci_parse($conn,$sql);
oci_execute($parse);
$total_all_rows = oci_fetch_all($parse, $result);

$columns = array(
	0 => 'EXAM_DATE',
	1 => 'ROOM_NO',
    2 => 'STUDENT_ID',
    3 => 'COURSE_CODE',
    4 => 'STATUS'
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " AND (STUDENT_ID like '%".$search_value."%'";
	$sql .= " OR COURSE_CODE like '%".$search_value."%'";
    $sql .= " OR STATUS like '%".$search_value."%')";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY STUDENT_ID desc";
}

if($_POST['length'] != -1)
{
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " OFFSET '". $start ."' ROWS FETCH NEXT '". $length ."' ROWS ONLY";
}	

$query = oci_parse($conn,$sql);
oci_execute($query);
$count_rows = oci_num_rows($query);
$data = array();
while($row =oci_fetch_array($query,OCI_ASSOC))
{

	$sub_array = array();
    $sub_array[] = $row['EXAM_DATE'];
    $sub_array[] = $row['ROOM_NO'];
	$sub_array[] = $row['STUDENT_ID'];
	$sub_array[] = $row['COURSE_CODE'];
    $sub_array[] = $row['STATUS'];
    $sub_array[] = '<a href="./pages/present.php?student_id='.$row['STUDENT_ID'].'&course_code='.$row['COURSE_CODE'].'&room_no='.$row['ROOM_NO'].'&exam_date='.$row['EXAM_DATE'].' "><button type="button" class="btn btn-xs btn-primary" >Present</button></a>  <a href="./pages/absent.php?student_id='.$row['STUDENT_ID'].'&course_code='.$row['COURSE_CODE'].'&room_no='.$row['ROOM_NO'].'&exam_date='.$row['EXAM_DATE'].' "><button type="button" class="btn btn-xs btn-danger" >Absent</button></a>'; 
	$data[] = $sub_array; 
}
$count_rows = oci_num_rows($query);
$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);


