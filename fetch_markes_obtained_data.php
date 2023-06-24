<?php include('connect.php');
session_start();

$output= array();
$sql = "SELECT STUDENT_ID,COURSE_CODE,CASE when SECTION_A is null then -1 Else SECTION_A END as SECTION_A,
CASE when SECTION_B is null then -1 Else SECTION_B END as SECTION_B from MARKS_OBTAINED where student_id=".$_SESSION['id']."  ";
$parse = oci_parse($conn,$sql);
oci_execute($parse);
$total_all_rows = oci_fetch_all($parse, $result);

$columns = array(
	0 => 'COURSE_CODE',
	1 => 'SECTION_A',
    2 => 'SECTION_B'
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " AND (COURSE_CODE like '%".$search_value."%'";
	$sql .= " OR SECTION_A like '%".$search_value."%'";
    $sql .= " OR SECTION_B like '%".$search_value."%')";
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
	$sub_array[] = $row['SECTION_A']==-1?'Not Assigned':$row['SECTION_A'];
	$sub_array[] = $row['SECTION_B']==-1?'Not Assigned':$row['SECTION_B'];
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


