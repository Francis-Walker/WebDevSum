<?php
error_reporting(0);
session_start();
error_reporting(E_ALL);
require('includes/fpdf182/fpdf.php');
include ('includes/dbFunctions.php');

class PDF extends FPDF
{
// Colored table
    function Table($farmID)
    {


        $table = getMemPDF($farmID);
        $header = array('Mem#', 'FirstName', 'Surname', 'IDNumber', 'Tel', 'Email', 'Plan#', 'Cost', 'Total Cost');
        $globalDeduction = 0;


        $this->Cell(12,7,$header[0],1);
        $this->Cell(20,7,$header[1],1);
        $this->Cell(20,7,$header[2],1);
        $this->Cell(25,7,$header[3],1);
        $this->Cell(25,7,$header[4],1);
        $this->Cell(70,7,$header[5],1);
        $this->Cell(10,7,$header[6],1);
        $this->Cell(10,7,$header[7],1);
        $this->Ln();
        $this->Ln();

        while($row =$table->fetch_array(MYSQLI_BOTH)  ) {


            $this->SetFillColor(224,235,255);
            $this->Cell(12,7,$row['memID'],1,0,'C',true);
            $this->Cell(20,7,$row['fnames'],1,0,'C',true);
            $this->Cell(20,7,$row['sname'],1,0,'C',true);
            $this->Cell(25,7,$row['IDnum'],1,0,'C',true);
            $this->Cell(25,7,$row['PhoneNum'],1,0,'C',true);
            $this->Cell(70,7,$row['email'],1,0,'C',true);
            $this->Cell(10,7,$row['planID'],1,0,'C',true);
            $this->Cell(10,7,$row['deductionAmount'],1,0,'C',true);
            $this->Ln();
            $deps = getDepPDF($row['memID']);

            $totalDeduction = $row['deductionAmount'];

            $this->SetFillColor(255,255,255);

            while($dep = $deps->fetch_array(MYSQLI_BOTH)){
                $this->Cell(12,7,$dep['depID'],1,0,'C',true);
                $this->Cell(20,7,$dep['fnames'],1,0,'C',true);
                $this->Cell(20,7,$dep['sname'],1,0,'C',true);
                $this->Cell(25,7,$dep['IDnum'],1,0,'C',true);
                $this->Cell(25,7,$dep['PhoneNum'],1,0,'C',true);
                $this->Cell(70,7,$dep['email'],1,0,'C',true);
                $this->Cell(10,7,$dep['planID'],1,0,'C',true);
                $this->Cell(10,7,$dep['deductionAmount'],1,0,'C',true);
                $totalDeduction += $dep['deductionAmount'];
                $this->Ln();



            }

            $this->Cell(145,7,'',1,0,'C',true);

            $this->SetFillColor(200,250,255);
            $this->Cell(37,7,'Total Deduction',1,0,'C',true);
            $this->Cell(10,7,$totalDeduction,1,0,'C',true);
            $globalDeduction+=$totalDeduction;
            $this->Ln();


            $this->Ln();
        }


        $this->SetFillColor(255,255,255);

        $this->Cell(145,7,'',1,0,'C',true);

        $this->SetFillColor(200,200,200);
        $this->Cell(37,7,"Total Due",1,0,'C',true);
        $this->Cell(10,7,$globalDeduction,1,0,'C',true);
        }




}


$pdf = new PDF();

if ($_SESSION['UserType']==0){
    $ID = $_SESSION['UserID'];
}
elseif (isset($_SESSION['farmID']) and ($_SESSION['UserType']==1))
{
 $ID =    $_SESSION['farmID'];
}



$pdf->SetFont('Arial','',9);

$pdf->AddPage();
$pdf->Table($ID);
$pdf->Output();
?>