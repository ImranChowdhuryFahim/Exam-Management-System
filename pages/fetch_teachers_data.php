<?php include('../connect.php');

echo "Please.....Hello .... spr";

$output= array();
$sql = "SELECT * FROM teachers ";
$parse = oci_parse($conn,$sql);
oci_execute($parse);
$total_all_rows = oci_num_rows($parse);

$columns = array(
	0 => 'TEACHER_ID',
	1 => 'TEACHER_NAME',
	2 => 'TEACHER_EMAIL',
	3 => 'TEACHER_CONTACT_NO',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE TEACHER_ID like '%".$search_value."%'";
	$sql .= " OR TEACHER_NAME like '%".$search_value."%'";
	$sql .= " OR TEACHER_EMAIL like '%".$search_value."%'";
	$sql .= " OR TEACHER_CONTACT_NO like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY id desc";
}

if($_POST['length'] != -1)
{
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  ".$start.", ".$length;
}	

$query = oci_parse($con,$sql);
oci_execute($query);
$count_rows = oci_num_rows($query);
$data = array();

<td><?php echo $row['TEACHER_ID']; ?></td>
<td><?php echo $row['TEACHER_NAME']; ?></td>
<td><?php echo $row['TEACHER_EMAIL']; ?></td>

<td><?php echo $row['TEACHER_CONTACT_NO']; ?></td>
while($row = oci_fetch_array($query,OCI_ASSOC))
{
	$sub_array = array();
	$sub_array[] = $row['TEACHER_ID'];
	$sub_array[] = $row['TEACHER_NAME'];
	$sub_array[] = $row['TEACHER_EMAIL'];
	$sub_array[] = $row['TEACHER_CONTACT_NO'];
	$sub_array[] = '<a href="javascript:void(); " href="edit_teacher.php?id=<?="'.$row['TEACHER_ID'];.'"?>" > <button type="button" class="btn btn-xs btn-primary" ><i class="fa fa-plus-square"></i></button></a>  <a href="javascript:void(); " href="view_teacher.php?id=<?="'.$row['TEACHER_ID'].'";?>&email=<?="'.$row['TEACHER_EMAIL'].'";?>" > <button type="button" class="btn btn-xs btn-danger" ><i class="fa fa-trash"></i></button></a>';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
//echo  json_encode($output);

