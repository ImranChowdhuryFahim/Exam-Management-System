<?php include('connect.php');


$output= array();
$sql = "SELECT * FROM student ";
$parse = oci_parse($conn,$sql);
oci_execute($parse);
$total_all_rows = oci_fetch_all($parse, $result);

$columns = array(
	0 => 'STUDENT_ID',
	1 => 'STUDENT_NAME',
	2 => 'STUDENT_EMAIL',
	3 => 'STUDENT_CONTACT_NO'
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE STUDENT_ID like '%".$search_value."%'";
	$sql .= " OR STUDENT_EMAIL like '%".$search_value."%'";
	$sql .= " OR STUDENT_NAME like '%".$search_value."%'";
	$sql .= " OR STUDENT_CONTACT_NO like '%".$search_value."%'";
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
	$sub_array[] = $row['STUDENT_NAME'];
	$sub_array[] = $row['STUDENT_EMAIL'];
	$sub_array[] = $row['STUDENT_CONTACT_NO'];
	$sub_array[] = '<a href="edit_student.php?id='.$row['STUDENT_ID'].'"><button type="button" class="btn btn-xs btn-primary" ><i class="fa fa-plus-square"></i></button></a>   <a href="view_student.php?id='.$row['STUDENT_ID'].'&email='.$row['STUDENT_EMAIL'].'" > <button type="button" class="btn btn-xs btn-danger" ><i class="fa fa-trash"></i></button></a>';
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


