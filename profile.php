<?php
session_start();
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

// Fetch logged-in user's data
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

// Fetch user's CVs
$cv_sql = "SELECT * FROM user_cv WHERE user_id = " . $user['id'];
$cv_result = $conn->query($cv_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="profile-page">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="profile-info">
                <img src="<?php echo $user['profile_picture']; ?>" alt="Profile Picture" class="profile-pic">
                <h3><?php echo $user['username']; ?></h3>
                <p><?php echo $user['email']; ?></p>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>

            <div class="nav-buttons">
                <a href="profile.php" class="nav-btn active">Your CV</a>
                <a href="build_cv.php" class="nav-btn">Build CV</a>
                <a href="home.php" class="nav-btn">HOME</a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h2>Your CVs</h2>
            <div class="cv-list">
                <?php while($cv = $cv_result->fetch_assoc()): ?>
                    <div class="cv-item">
                        <h4>CV (Uploaded on <?php echo $cv['created_at']; ?>)</h4>
                        <!-- Embed the PDF -->
                        <embed src="<?php echo $cv['cv_file']; ?>" type="application/pdf" width="100%" height="600px" />
                        <div class="cv-actions">
                            <a href="<?php echo $cv['cv_file']; ?>" download>Download CV</a>
                            <!-- Delete Button -->
                            <form action="delete_cv.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this CV?');">
                                <input type="hidden" name="cv_id" value="<?php echo $cv['id']; ?>">
                                <button type="submit" class="delete-btn">Delete CV</button>
                            </form>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

    <style>
        body{
            background-color:#000000;
        }
        .profile-page {
            display: flex;
            
            min-height: 800px;
        }
        .sidebar {
            width: 250px;
            background-color: #290750e4;
            padding: 20px;
            border-radius: 20px;
        }

        a:-webkit-any-link {
            font-family: "Montserrat", sans-serif;
            background-color: #290750e4;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 20px;
            border: 2px solid #ffffff;
            text-decoration:none;
        }
        a:-webkit-any-link:hover {
            background-color: #9d3633;
        }
        .profile-info {
            font-family: "Montserrat", sans-serif;
            text-align: center;
            color: #ffffff;
        }
        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }
        .nav-buttons {
            font-family: "Montserrat", sans-serif;
            margin-top: 20px;
        }
        .nav-btn {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #ffffff;
            background-color: #e0a3ffa5;
            margin-bottom: 10px;
            text-align: center;
            border-radius: 20px;
            border: 2px solid #ffffff;
        }
        .nav-btn:hover {
            background-color: #d332ffb4;
        }
        .nav-btn.active {
            background-color: #d332ffb4;
        }
        .main-content {
            font-family: "Montserrat", sans-serif;
            flex-grow: 1;
            padding: 20px;
            color:#290750e4;
            font-size:20pt;
            background-color:#dec4fae4;
            border-radius:20px;
        }
        .cv-list {
            margin-top: 20px;
        }
        .cv-item {
            padding: 10px;
            border-bottom: 1px solid #ccc;
            margin-bottom: 20px;
            
        }
        .cv-item h4{
            font-weight:400;
        }
        .cv-actions {
            margin-top: 10px;
        }
        
        .delete-btn {
            font-family: "Montserrat", sans-serif;
            background-color: #d9534f;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 20px;
            border: 2px solid #ffffff;
            margin-top:20px;
        }
        .delete-btn:hover{
            background-color: #9d3633;
        }
        .logout-btn {
            font-family: "Montserrat", sans-serif;
            display: block;
            background-color: #d9534f;
            color: white;
            padding: 10px;
            text-decoration: none;
            text-align: center;
            margin-top: 10px;
            border-radius: 20px;
            border: 2px solid #ffffff;
        }
        .logout-btn:hover{
            background-color: #9d3633;
        } 
    </style>
</body>
</html>
