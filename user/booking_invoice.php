<?php
session_start(); // Start the session
require('fpdf.php');
include "config.php";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM booking where traveller_id='".$_SESSION['id']."'"); 
    $stmt->execute();

    $data = $stmt->fetchAll();
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Helvetica','B',15);
        $this->SetXY(85, 20);
        $this->Cell(100,10,'Booking Details',0,1);
      
        $this->SetFillColor(192,192,192);
        $this->SetDrawColor(50,50,100);
        $this->SetY(35);
        $this->Cell(10,10,'Id',1,0,'',true);
        $this->Cell(30,10,'Cust Name',1,0,'',true);
        $this->Cell(20,10,'State',1,0,'',true);
        $this->Cell(50,10,'Package Name',1,0,'',true);
        $this->Cell(30,10,'From Date',1,0,'',true);
        $this->Cell(30,10,'To Date',1,0,'',true);
        $this->Cell(25,10,'Amount',1,1,'',true);
    }

    function Footer()
    {
        $this->SetXY(100,-15);
        $this->SetFont('Arial','I',10);
        $this->Write(5, 'This is a footer');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages('{pages}');
$pdf->AddPage();
$pdf->SetFont('Arial','', 9);
$pdf->SetDrawColor(50,50,100);

if ($data) {
    foreach ($data as $value) {
        $stmt1 = $conn->prepare("SELECT * FROM travellers where id='".$value['traveller_id']."'");
        $stmt1->execute();
        $cust = $stmt1->fetch(PDO::FETCH_ASSOC);

        $stmt2 = $conn->prepare("SELECT * FROM packages where id='".$value['package_id']."'");
        $stmt2->execute();
        $package = $stmt2->fetch(PDO::FETCH_ASSOC);

        $stmt3 = $conn->prepare("SELECT * FROM payment where booking_id='".$value['id']."'");
        $stmt3->execute();
        $payment = $stmt3->fetch(PDO::FETCH_ASSOC);

        // Check if all queries returned results
        if ($cust && $package && $payment) {
            $pdf->Cell(10,10,$value['id'],1,0);
            $pdf->Cell(30,10,$cust['name'],1,0);
            $pdf->Cell(20,10,$cust['state_name'],1,0);
            $pdf->Cell(50,10,$package['pname'],1,0);
            $pdf->Cell(30,10,$value['from_date'],1,0);
            $pdf->Cell(30,10,$value['to_date'],1,0);
            $pdf->Cell(25,10,$value['total_amount'],1,1);
        } else {
            // Handle the case where one of the queries didn't return any result
            // For example:
            $pdf->Cell(0, 10, "Error: Data not found for booking ID ".$value['id'], 0, 1);
        }
    }
} else {
    $pdf->Cell(0, 10, "No bookings found for this user.", 0, 1);
}

$pdf->Output();
?>
