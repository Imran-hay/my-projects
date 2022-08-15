<?php
require('pdf/fpdf.php');
if (!isset($_SESSION)) 
    {session_start();}
 require_once('../config/connection.php');

 if(isset($_GET['print']))
 {
	class PDF extends FPDF
{
// Page header
function Header()
{
	// Logo
	$this->Image('../resources/images/logo.png',10,6,30);
	// Arial bold 15
	$this->SetFont('Arial','B',15);
	// Move to the right
	$this->Cell(80);
	// Title
	$this->Cell(100,10,'Hagere Eat Simple Receipt',1,2,'C');
	// Line break
	$this->Ln(20);
}

// Page footer
function Footer()
{
	// Position at 1.5 cm from bottom
	$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// Page number
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
$id=$_GET['id'];
$sql=mysqli_query($con,"SELECT * FROM orders WHERE id=$id");
$row=mysqli_fetch_assoc($sql);
$foods=array();
$amounts=array();
$foods = explode (",", $row['food']); 
$amounts = explode (",", $row['amount']); 

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Cell(0,10,"Food \t\t\t         Amount \t    Price",0,1);
for($i=0;$i<count($foods)-1;$i++)
{
	$food=intval($foods[$i]);
	$amount=intval($amounts[$i]);
	$query=mysqli_query($con,"SELECT * FROM menu WHERE id=$food");
	$result=mysqli_fetch_assoc($query);
	$name=$result['food'];
	$price=$result['price'];
	$pdf->Cell(0,10,"$name \t\t\t $amount \t $price",0,1);
	
}
$subtotal=$row['total']-25;
$total=$row['total'];
$pdf->Ln(10);
$pdf->Cell(0,10,"Subtotal: \t $subtotal ETB",0,1);
$pdf->Cell(0,10,"Delivery: \t 25 ETB",0,1);
$pdf->Cell(0,10,"Total: \t $total ETB",0,1);


$pdf->Output();
header('Location: ../public/receipt.php');
exit;
 }


?>
