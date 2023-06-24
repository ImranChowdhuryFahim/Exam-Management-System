<?php include('connect.php');
session_start();

$output= array();
$course_code = $_SESSION['course_code'];
$sql = "SELECT STUDENT_ID,COURSE_CODE,CASE when SECTION_A is null then -1 Else SECTION_A END as SECTION_A,
CASE when SECTION_B is null then -1 Else SECTION_B END as SECTION_B from MARKS_OBTAINED where COURSE_CODE='".$course_code."' ";
$parse = oci_parse($conn,$sql);
oci_execute($parse);
$total_all_rows = oci_fetch_all($parse, $result);

$columns = array(
	0 => 'STUDENT_ID',
	1 => 'COURSE_CODE',
    2 => 'SECTION_A',
    3 => 'SECTION_B'
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " AND (STUDENT_ID like '%".$search_value."%'";
	$sql .= " OR COURSE_CODE like '%".$search_value."%'";
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
    $a = "SELECT count(section) as A from courses_responsibility where course_code='" . $row['COURSE_CODE'] . "' and section='A'";
    $p1 = oci_parse($conn,$a);
    oci_execute($p1);
    $r1= oci_fetch_array($p1,OCI_ASSOC);
    $b = "SELECT count(section) as B from courses_responsibility where course_code='" . $row['COURSE_CODE'] . "' and section='B'";
    $p2 = oci_parse($conn,$b);
    oci_execute($p2);
    $r2= oci_fetch_array($p2,OCI_ASSOC);
    $A= 'A';
    $B= 'B';

	$sub_array = array();
    $sub_array[] = $row['STUDENT_ID'];
    $sub_array[] = $row['COURSE_CODE'];
	$sub_array[] = $row['SECTION_A']==-1?'Not Assigned':$row['SECTION_A'];
	$sub_array[] = $row['SECTION_B']==-1?'Not Assigned':$row['SECTION_B'];
    $sub_array[] = ($r1['A']==1 && $r2['B']==1)?'<a href="assign_marks_a.php?student_id='.$row['STUDENT_ID'].'&course_code='.$row['COURSE_CODE'].'&section='.$A.' "><button type="button" class="btn btn-xs btn-primary" >A</button></a> <a href="assign_marks_a.php?student_id='.$row['STUDENT_ID'].'&course_code='.$row['COURSE_CODE'].'&section='.$B.' "><button type="button" class="btn btn-xs btn-primary" >B</button></a>':
    ($r1['A']==1?'<a href="assign_marks_a.php?student_id='.$row['STUDENT_ID'].'&course_code='.$row['COURSE_CODE'].'&section='.$A.' "><button type="button" class="btn btn-xs btn-primary" >A</button></a>':
    '<a href="assign_marks_a.php?student_id='.$row['STUDENT_ID'].'&course_code='.$row['COURSE_CODE'].'&section='.$B.' "><button type="button" class="btn btn-xs btn-primary" >B</button></a>');
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


