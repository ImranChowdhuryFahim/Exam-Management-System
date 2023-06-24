<?php include('connect.php');


$output= array();
$sql = "SELECT student_id,course_code,exam_date,room_no,Case when room_no is null then 'Not Assigned' Else room_no End as room_no
FROM  attendance ";
$parse = oci_parse($conn,$sql);
oci_execute($parse);
$total_all_rows = oci_fetch_all($parse, $result);

$columns = array(
	0 => 'STUDENT_ID',
	1 => 'COURSE_CODE',
	2 => 'EXAM_DATE',
    3 => 'ROOM_NO'
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE STUDENT_ID like '%".$search_value."%'";
	$sql .= " OR COURSE_CODE like '%".$search_value."%'";
	$sql .= " OR EXAM_DATE like '%".$search_value."%'";
    $sql .= " OR ROOM_NO like '%".$search_value."%'";
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
	$sub_array[] = $row['STUDENT_ID'];
	$sub_array[] = $row['COURSE_CODE'];
	$sub_array[] = $row['EXAM_DATE'];
    $sub_array[] = $row['ROOM_NO'];
	$sub_array[] = '<a href="view_exam_request.php?student_id='.$row['STUDENT_ID'].'&course_code='.$row['COURSE_CODE'].'&exam_date='.$row['EXAM_DATE'].'"><button type="button" class="btn btn-xs btn-danger" ><i class="fa fa-trash"></i></button></a>';
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


