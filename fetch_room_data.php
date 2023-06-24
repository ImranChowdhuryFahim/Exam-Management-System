<?php include('connect.php');


$output= array();
$sql = "SELECT * FROM room ";
$parse = oci_parse($conn,$sql);
oci_execute($parse);
$total_all_rows = oci_fetch_all($parse, $result);

$columns = array(
	0 => 'ROOM_NO',
	1 => 'CAPACITY',
	2 => 'LOCATION',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE ROOM_NO like '%".$search_value."%'";
	$sql .= " OR CAPACITY like '%".$search_value."%'";
	$sql .= " OR LOCATION like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY ROOM_NO desc";
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
	$sub_array[] = $row['ROOM_NO'];
	$sub_array[] = $row['CAPACITY'];
	$sub_array[] = $row['LOCATION'];
	$sub_array[] = '<a href="edit_room.php?room_no='.$row['ROOM_NO'].'"><button type="button" class="btn btn-xs btn-primary" ><i class="fa fa-plus-square"></i></button></a>   <a href="view_room.php?room_no='.$row['ROOM_NO'].'" > <button type="button" class="btn btn-xs btn-danger" ><i class="fa fa-trash"></i></button></a>';
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


