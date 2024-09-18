<?php
session_start();
include 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Check if CV ID is provided
if (isset($_POST['cv_id'])) {
    $cv_id = $_POST['cv_id'];

    // Fetch the CV file path before deletion
    $cv_sql = "SELECT cv_file FROM user_cv WHERE id = $cv_id";
    $cv_result = $conn->query($cv_sql);
    $cv = $cv_result->fetch_assoc();

    // Delete the CV from the database
    $sql = "DELETE FROM user_cv WHERE id = $cv_id";

    if ($conn->query($sql) === TRUE) {
        // Remove the file from the server
        if (file_exists($cv['cv_file'])) {
            unlink($cv['cv_file']);
        }

        // Redirect back to the profile page after deletion
        header('Location: profile.php');
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
