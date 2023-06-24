<?php include('connect.php');


$output= array();
$sql = "SELECT COURSE_CODE,TEACHER_NAME,TEACHER_ID,SECTION FROM COURSES_RESPONSIBILITY_VIEW ";
$parse = oci_parse($conn,$sql);
oci_execute($parse);
$total_all_rows = oci_fetch_all($parse, $result);

$columns = array(
	0 => 'COURSE_CODE',
	1 => 'TEACHER_NAME',
	2 => 'SECTION',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE COURSE_CODE like '%".$search_value."%'";
	$sql .= " OR TEACHER_NAME like '%".$search_value."%'";
	$sql .= " OR SECTION like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY COURSE_CODE desc";
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
	$sub_array[] = $row['COURSE_CODE'];
	$sub_array[] = $row['TEACHER_NAME'];
	$sub_array[] = $row['SECTION'];
	$sub_array[] = '<a href="view_course_responsibility.php?course_code='.$row['COURSE_CODE'].'&teacher_id='.$row['TEACHER_ID'].'&section='.$row['SECTION'].'" > <button type="button" class="btn btn-xs btn-danger" ><i class="fa fa-trash"></i></button></a>';
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


