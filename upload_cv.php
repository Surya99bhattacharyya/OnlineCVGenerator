<?php
session_start();
include 'config.php';
require('fpdf186/fpdf.php'); // Include the FPDF library

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

// Get the logged-in user's username
$username = $_SESSION['username'];

// Fetch user ID based on the username
$sql = "SELECT id FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $user_id = $user['id']; // Get the user ID
} else {
    echo "User not found!";
    exit();
}

// Handle form data
$firstname = $_POST['firstname'];
$middlename = isset($_POST['middlename']) ? $_POST['middlename'] : '';
$lastname = $_POST['lastname'];
$image = $_FILES['image']['tmp_name'];
$designation = $_POST['designation'];
$address = $_POST['address'];
$email = $_POST['email'];
$phoneno = $_POST['phoneno'];
$summary = $_POST['summary'];
$achieve_title = $_POST['achieve_title'];
$achieve_description = $_POST['achieve_description '];
$exp_title = $_POST['exp_title'];
$exp_organization = $_POST['exp_organization'];
$exp_location = $_POST['exp_location'];
$exp_start_date = $_POST['exp_start_date'];
$exp_end_date = $_POST['exp_end_date'];
$exp_description = $_POST['exp_description'];
$edu_institution = $_POST['edu_institution'];
$edu_degree = $_POST['edu_degree'];
$edu_start_date = $_POST['edu_start_date'];
$edu_end_date = $_POST['edu_end_date'];
$edu_location = $_POST['edu_location'];

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFillColor(0, 102, 204);

// Add header
$pdf->SetY(10);
$pdf->SetX(10);
$pdf->SetFillColor(0, 102, 204); // Dark Blue Header Background
$pdf->Rect(10, 10, 190, 20, 'F'); // Draw header background
$pdf->SetTextColor(255, 255, 255); // White text
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, "Curriculum Vitae", 0, 1, 'C', true);
$pdf->SetTextColor(0, 0, 0); // Reset text color
$pdf->Ln(10); // Add some space after header

// Personal Details
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetFillColor(230, 230, 230);
$pdf->Cell(0, 10, "Personal Details", 0, 1, 'L', true);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, "Name: " . $firstname . " " . $middlename . " " . $lastname, 0, 1);
$pdf->Cell(0, 10, "Designation: " . $designation, 0, 1);
$pdf->Cell(0, 10, "Address: " . $address, 0, 1);
$pdf->Cell(0, 10, "Email: " . $email, 0, 1);
$pdf->Cell(0, 10, "Phone No: " . $phoneno, 0, 1);
$pdf->Ln(5); // Add space before next section

// Add separator line
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
$pdf->Ln(5); // Space after separator

// Summary
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetFillColor(230, 230, 230);
$pdf->Cell(0, 10, "Summary", 0, 1, 'L', true);
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 10, $summary);
$pdf->Ln(5);

// Achievements
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetFillColor(230, 230, 230);
$pdf->Cell(0, 10, "Achievements", 0, 1, 'L', true);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, "Title: " . $achieve_title, 0, 1);
$pdf->MultiCell(0, 10, "Description: " . $achieve_description);
$pdf->Ln(5);

// Experience (use table format)
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetFillColor(230, 230, 230);
$pdf->Cell(0, 10, "Experience", 0, 1, 'L', true);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, "Job Title: " .$exp_title, 0, 1);
$pdf->Cell(0, 10, "Company: " . $exp_organization, 0, 1);
$pdf->Cell(0, 10, "Location: " . $exp_location, 0, 1);
$pdf->Cell(0, 10, "Duration: " . $exp_start_date . " - " . $exp_end_date, 0, 1);
$pdf->MultiCell(0, 10, "Description: " . $exp_description);
$pdf->Ln(5);

// Education (use table format)
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetFillColor(230, 230, 230);
$pdf->Cell(0, 10, "Education", 0, 1, 'L', true);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, "School: " . $edu_institution, 0, 1);
$pdf->Cell(0, 10, "Degree: " . $edu_degree, 0, 1);
$pdf->Cell(0, 10, "City: " . $edu_location, 0, 1);
$pdf->Cell(0, 10, "Duration: " . $edu_start_date . " - " . $edu_end_date, 0, 1);
$pdf->Ln(5);

// Image Handling (Optional: Embed image in PDF)
// Ensure the image file is moved to a permanent location if needed
if (!empty($image)) {
    $image_path = "uploads/images/" . basename($_FILES['image']['name']);
    move_uploaded_file($image, $image_path);
    $pdf->Image($image_path, 150, 20, 50); // Adjust position and size as needed
}

// Optional: Add footer with page number
// $pdf->SetY(-15);
// $pdf->SetFont('Arial', 'I', 8);
// $pdf->Cell(0, 10, 'Page ' . $pdf->PageNo(), 0, 0, 'C');

// Save the generated PDF
$form_pdf_file = $target_dir . "form_cv_" . time() . ".pdf";
$pdf->Output($form_pdf_file, 'F'); // Save PDF


// Insert the generated PDF into the user_cv table
$sql = "INSERT INTO user_cv (user_id, cv_file, created_at) VALUES (?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $user_id, $form_pdf_file);

if ($stmt->execute()) {
    echo "CV generated and uploaded successfully.";
    header("Location: profile.php"); // Redirect to profile page
    exit();
} else {
    echo "Error: " . $stmt->error;
}


?>
