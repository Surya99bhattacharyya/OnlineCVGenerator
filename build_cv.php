<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Build Your CV</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        /* Basic styling for the CV form */
        body {
            font-family: "Montserrat", sans-serif;
            background-color: #26005a;
        }

        h2 {
            text-align: center;
            color: #ffffff;
        }

        #cv-form {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
        }

        .cv-form-blk {
            margin-bottom: 20px;
        }

        .cv-form-row-title h3 {
            margin-bottom: 10px;
        }

        .form-elem {
            margin-bottom: 15px;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 8px;
        }

        .close-btn {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close-btn:hover,
        .close-btn:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <script src="scripts.js" defer></script>
</head>
<body>
    <h2>Build Your CV</h2>
    <form action="upload_cv.php" method="POST" enctype="multipart/form-data" id="cv-form">
        <section id="about-sc">
            <div class="container">
                <div class="about-cnt">
                    <!-- Personal Details Section -->
                    <div class="cv-form-blk">
                        <div class="cv-form-row-title">
                            <h3>About Section</h3>
                        </div>
                        <div class="cv-form-row cv-form-row-about">
                            <div class="cols-3">
                                <div class="form-elem">
                                    <label for="firstname" class="form-label">First Name</label>
                                    <input name="firstname" type="text" class="form-control" id="firstname" placeholder="e.g. John" onkeyup="generateCV()" required>
                                </div>
                                <div class="form-elem">
                                    <label for="middlename" class="form-label">Middle Name <span class="opt-text">(optional)</span></label>
                                    <input name="middlename" type="text" class="form-control" id="middlename" placeholder="e.g. Herbert">
                                </div>
                                <div class="form-elem">
                                    <label for="lastname" class="form-label">Last Name</label>
                                    <input name="lastname" type="text" class="form-control" id="lastname" placeholder="e.g. Doe" onkeyup="generateCV()" required>
                                </div>
                            </div>

                            <div class="cols-3">
                                <div class="form-elem">
                                    <label for="image" class="form-label">Your Image</label>
                                    <input name="image" type="file" class="form-control" id="image" accept="image/*" onchange="previewImage()" required>
                                </div>
                                <div class="form-elem">
                                    <label for="designation" class="form-label">Designation</label>
                                    <input name="designation" type="text" class="form-control" id="designation" placeholder="e.g. Sr. Accountant" onkeyup="generateCV()" required>
                                </div>
                                <div class="form-elem">
                                    <label for="address" class="form-label">Address</label>
                                    <input name="address" type="text" class="form-control" id="address" placeholder="e.g. Lake Street-23" onkeyup="generateCV()" required>
                                </div>
                            </div>

                            <div class="cols-3">
                                <div class="form-elem">
                                    <label for="email" class="form-label">Email</label>
                                    <input name="email" type="email" class="form-control" id="email" placeholder="e.g. johndoe@gmail.com" onkeyup="generateCV()" required>
                                </div>
                                <div class="form-elem">
                                    <label for="phoneno" class="form-label">Phone No:</label>
                                    <input name="phoneno" type="tel" class="form-control" id="phoneno" placeholder="e.g. 456-768-798" onkeyup="generateCV()" required>
                                </div>
                                <div class="form-elem">
                                    <label for="summary" class="form-label">Summary</label>
                                    <input name="summary" type="text" class="form-control" id="summary" placeholder="e.g. Professional accountant with 10 years of experience." onkeyup="generateCV()" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Achievements Section -->
                    <div class="cv-form-blk">
                        <div class="cv-form-row-title">
                            <h3>Achievements</h3>
                        </div>
                        <div class="row-separator repeater">
                            <div class="repeater" data-repeater-list="group-a">
                                <div data-repeater-item>
                                    <div class="cv-form-row cv-form-row-achievement">
                                        <div class="cols-2">
                                            <div class="form-elem">
                                                <label for="achieve_title" class="form-label">Title</label>
                                                <input name="achieve_title" type="text" class="form-control" id="achieve_title" placeholder="e.g. Best Employee of the Year" onkeyup="generateCV()" required>
                                            </div>
                                            <div class="form-elem">
                                                <label for="achieve_description" class="form-label">Description</label>
                                                <input name="achieve_description" type="text" class="form-control" id="achieve_description" placeholder="e.g. Awarded for outstanding performance." onkeyup="generateCV()" required>
                                            </div>
                                        </div>
                                        <button data-repeater-delete type="button" class="repeater-remove-btn">-</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" data-repeater-create class="repeater-add-btn">+</button>
                        </div>
                    </div>

                    <!-- Experience Section -->
                    <div class="cv-form-blk">
                        <div class="cv-form-row-title">
                            <h3>Experience</h3>
                        </div>
                        <div class="row-separator repeater">
                            <div class="repeater" data-repeater-list="group-b">
                                <div data-repeater-item>
                                    <div class="cv-form-row cv-form-row-experience">
                                        <div class="cols-3">
                                            <div class="form-elem">
                                                <label for="exp_title" class="form-label">Job Title</label>
                                                <input name="exp_title" type="text" class="form-control" id="exp_title" placeholder="e.g. Software Engineer" onkeyup="generateCV()" required>
                                            </div>
                                            <div class="form-elem">
                                                <label for="exp_organization" class="form-label">Company / Organization</label>
                                                <input name="exp_organization" type="text" class="form-control" id="exp_organization" placeholder="e.g. XYZ Corp" onkeyup="generateCV()" required>
                                            </div>
                                            <div class="form-elem">
                                                <label for="exp_location" class="form-label">Location</label>
                                                <input name="exp_location" type="text" class="form-control" id="exp_location" placeholder="e.g. New York" onkeyup="generateCV()" required>
                                            </div>
                                        </div>

                                        <div class="cols-3">
                                            <div class="form-elem">
                                                <label for="exp_start_date" class="form-label">Start Date</label>
                                                <input name="exp_start_date" type="date" class="form-control" id="exp_start_date" onkeyup="generateCV()" required>
                                            </div>
                                            <div class="form-elem">
                                                <label for="exp_end_date" class="form-label">End Date</label>
                                                <input name="exp_end_date" type="date" class="form-control" id="exp_end_date" onkeyup="generateCV()" required>
                                            </div>
                                            <div class="form-elem">
                                                <label for="exp_description" class="form-label">Description</label>
                                                <input name="exp_description" type="text" class="form-control" id="exp_description" placeholder="e.g. Developed software solutions." onkeyup="generateCV()" required>
                                            </div>
                                        </div>
                                        <button data-repeater-delete type="button" class="repeater-remove-btn">-</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" data-repeater-create class="repeater-add-btn">+</button>
                        </div>
                    </div>

                    <!-- Education Section -->
                    <div class="cv-form-blk">
                        <div class="cv-form-row-title">
                            <h3>Education</h3>
                        </div>
                        <div class="row-separator repeater">
                            <div class="repeater" data-repeater-list="group-c">
                                <div data-repeater-item>
                                    <div class="cv-form-row cv-form-row-education">
                                        <div class="cols-3">
                                            <div class="form-elem">
                                                <label for="edu_institution" class="form-label">Institution</label>
                                                <input name="edu_institution" type="text" class="form-control" id="edu_institution" placeholder="e.g. Harvard University" onkeyup="generateCV()" required>
                                            </div>
                                            <div class="form-elem">
                                                <label for="edu_degree" class="form-label">Degree</label>
                                                <input name="edu_degree" type="text" class="form-control" id="edu_degree" placeholder="e.g. B.Sc. in Computer Science" onkeyup="generateCV()" required>
                                            </div>
                                            <div class="form-elem">
                                                <label for="edu_start_date" class="form-label">Start Date</label>
                                                <input name="edu_start_date" type="date" class="form-control" id="edu_start_date" onkeyup="generateCV()" required>
                                            </div>
                                        </div>

                                        <div class="cols-3">
                                            <div class="form-elem">
                                                <label for="edu_end_date" class="form-label">End Date</label>
                                                <input name="edu_end_date" type="date" class="form-control" id="edu_end_date" onkeyup="generateCV()" required>
                                            </div>
                                            <div class="form-elem">
                                                <label for="edu_location" class="form-label">Location</label>
                                                <input name="edu_location" type="text" class="form-control" id="edu_location" placeholder="e.g. Cambridge, MA" onkeyup="generateCV()" required>
                                            </div>
                                        </div>
                                        <button data-repeater-delete type="button" class="repeater-remove-btn">-</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" data-repeater-create class="repeater-add-btn">+</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="form-elem">
            <button type="submit" class="btn-primary">Build CV</button>
            
        </div>
    </form>

    <!-- Modal for Image Preview -->
    <div id="image-preview-modal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <img id="preview-image" src="" alt="Image Preview" style="width: 100%; height: auto;">
        </div>
        <button class="btn-primary" href="home.php">Home</button>
    </div>
    
</body>
</html>
