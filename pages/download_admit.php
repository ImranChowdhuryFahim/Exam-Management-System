<?php
require('../pdf/fpdf.php');

class PDF extends FPDF
{

// Page header
function Header()
{
	// Logo
	// $this->Image('logo.png',10,6,30);
	// Arial bold 15
	$this->SetFont('Times','B',15);
	// Move to the right
	$this->Cell(80);
	// Title
	$this->Cell(30,10,'Admit Card',1,0,'C');
	// Line break
	$this->Ln(30);
}

// Page footer
function Footer()
{
	// Position at 1.5 cm from bottom
	$this->SetY(-35);
	// Arial italic 8
	$this->SetFont('Times','I',8);

	$this->Line(150, 264, 190, 264);
	// Page number
	$this->Cell(320,10,'Signature of Head',0,0,'C');
}
// Load data
function LoadData()
{

	include '../connect.php';
	session_start();
    
	$sql1 = "SELECT exam_scheduling.course_code,to_char(exam_scheduling.start_time,'HH.MI AM') as start_time,
            to_char(exam_scheduling.end_time,'HH.MI AM') as end_time,exam_scheduling.exam_date,
            CASE when attendance.room_no is null THEN 'Not Assigned' ELSE attendance.room_no END as room_no FROM  attendance
            join exam_scheduling on attendance.course_code=exam_scheduling.course_code and 
            attendance.exam_date=exam_scheduling.exam_date  WHERE attendance.student_id='".$_SESSION["id"]."'";
	$parse = oci_parse($conn,$sql1);
	oci_execute($parse);
	$data = array();
	while($row=oci_fetch_array($parse,OCI_ASSOC))
	{
        $str =  implode(";",$row);
        // echo $str;
        $data[]=explode(';',$str);
	}
	return $data;
}


// Simple table
function BasicTable($header, $data,$student_id, $student_name)
{
	// Header
	$this->Cell(10,7,"ID: ");
	$this->Cell(38,7,$student_id);
	$this->Ln(5);
	$this->Cell(15,7,"Name: ");
	$this->Cell(38,7,$student_name);
	$this->Ln(10);
	foreach($header as $col)
		$this->Cell(38,7,$col,1);
	$this->Ln();
	// Data
	foreach($data as $row)
	{
		foreach($row as $col)
			$this->Cell(38,6,$col,1);
		$this->Ln();
	}
}

}

$pdf = new PDF('P','mm','A4');
// Column headings
$header = array('Course Code', 'Start Time', 'End Time', 'Date','Room No');
// Data loading
$data = $pdf->LoadData();
$id = $_SESSION['id'];
$name = $_SESSION['name'];
$pdf->SetFont('Times','',14);
$pdf->AddPage();
$pdf->BasicTable($header,$data,$id,$name);
$pdf->Output();
?>
