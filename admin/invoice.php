<?php
require('fpdf.php');
include "config.php";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM booking;"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
  
    $data=$stmt->fetchAll();
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

class PDF extends FPDF
{
    function Header()
    {
        // Include font file using the PHP script
        require('fonthelveticab.php');

        // Set the font
        $this->SetFont('Helvetica', '', 12);

        // Header content
        $this->Cell(0, 10, 'Income Report', 0, 1, 'C');
        $this->Ln(10); // Add some space
    }

    function Footer()
    {
        // Footer content
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();

foreach ($data as $value) {
    // Your data processing and cell output here
}

$pdf->Output();
?>
