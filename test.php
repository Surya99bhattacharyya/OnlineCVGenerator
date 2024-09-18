<?php
require('fpdf186/fpdf.php'); // Adjust path to your FPDF library

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $experience = $_POST['experience'];
    $education = $_POST['education'];
    $template = $_POST['template'];

    $pdf = new FPDF();
    $pdf->AddPage();

    // Customize PDF content based on selected template
    switch ($template) {
        case 'template1':
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(0, 10, 'Resume - Template 1', 0, 1, 'C');
            break;
        case 'template2':
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(0, 10, 'Resume - Template 2', 0, 1, 'C');
            break;
        case 'template3':
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(0, 10, 'Resume - Template 3', 0, 1, 'C');
            break;
        default:
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(0, 10, 'Resume', 0, 1, 'C');
            break;
    }

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, "Name: $name", 0, 1);
    $pdf->Cell(0, 10, "Email: $email", 0, 1);
    $pdf->Cell(0, 10, "Phone: $phone", 0, 1);
    $pdf->Ln(10);

    $pdf->Cell(0, 10, 'Experience:', 0, 1);
    $pdf->MultiCell(0, 10, $experience);
    $pdf->Ln(10);

    $pdf->Cell(0, 10, 'Education:', 0, 1);
    $pdf->MultiCell(0, 10, $education);

    // Output PDF
    $pdf->Output('D', 'resume.pdf'); // Download as PDF
}
?>
