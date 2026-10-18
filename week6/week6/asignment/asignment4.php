<?php
session_start();
$error = "";

if (isset($_POST["register"])) {
     if(empty($_POST["full_name"]) && empty($_POST["place_of_birth"]) && empty($_POST["date_of_birth"]) && empty($_POST["address"]) && empty($_POST["gender"]) && empty($_POST["phone_number"]) && empty($_POST["email"]) && empty($_FILES["student_profile_picture"]["name"]) && empty($_POST["parent_name"]) && empty($_POST["parent_phone_number"]) && empty($_POST["relationship_with_student"]) && empty($_POST["student_id"]) && empty($_POST["faculty"]) && empty($_POST["department"]) && empty($_POST["class"]) && empty($_POST["year_of_registration"])) {
        $error = "Please fill in all the required fields.";
    }
    elseif (empty($_POST["full_name"])) {
        $error = "Please enter your full name.";

    } elseif (!preg_match("/^[a-zA-Z ]+$/", $_POST["full_name"])) {
        $error = "Name must contain only letters and spaces.";

    } elseif (empty($_POST["place_of_birth"])) {
        $error = "Please enter your place of birth.";

    } elseif (empty($_POST["date_of_birth"])) {
        $error = "Please enter your date of birth.";

    } elseif (empty($_POST["address"])) {
        $error = "Please enter your address.";

    } elseif (empty($_POST["gender"])) {
        $error = "Please select your gender.";

    } elseif (empty($_POST["phone_number"])) {
        $error = "Please enter your phone number.";

    } elseif (empty($_POST["email"])) {
        $error = "Please enter your email.";

    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";

    } elseif (empty($_FILES["student_profile_picture"]["name"])) {
        $error = "Please select a profile picture.";

    } elseif (empty($_POST["parent_name"])) {
        $error = "Please enter the parent name.";

    } elseif (empty($_POST["parent_phone_number"])) {
        $error = "Please enter the parent phone number.";

    } elseif (empty($_POST["relationship_with_student"])) {
        $error = "Please enter the relationship with the student.";

    } elseif (empty($_POST["student_id"])) {
        $error = "Please enter the student ID.";

    } elseif (empty($_POST["faculty"])) {
        $error = "Please enter the faculty.";

    } elseif (empty($_POST["department"])) {
        $error = "Please enter the department.";

    } elseif (empty($_POST["class"])) {
        $error = "Please enter the class.";

    } elseif (empty($_POST["year_of_registration"])) {
        $error = "Please enter the year of registration.";

    } else {
        $_SESSION["student"] = $_POST;
        $_SESSION["student"]["student_profile_picture"] =
        $_FILES["student_profile_picture"]["name"];
         header("Location: success.php");
         exit();
    }
}
?>
<?php if (!empty($error)) { ?>
    <div class="error-message">
        <span class="error-icon">!</span>
        <span><?php echo htmlspecialchars($error); ?></span>
    </div>
<?php } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
            padding: 40px 16px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
        }

        .page-header {
            margin-bottom: 28px;
        }

        .page-header h1 {
            font-size: 30px;
            margin-bottom: 8px;
            color: #0f172a;
        }

        .page-header p {
            color: #64748b;
            font-size: 14px;
        }

        .form-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 24px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.04);
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 26px;
            padding-bottom: 18px;
            border-bottom: 1px solid #e2e8f0;
        }

        .section-number {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #dbeafe;
            color: #1d4ed8;
            border-radius: 12px;
            font-weight: bold;
            font-size: 17px;
        }

        .section-header h2 {
            font-size: 19px;
            margin-bottom: 5px;
        }

        .section-header p {
            font-size: 13px;
            color: #64748b;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 9px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        label {
            font-size: 13px;
            font-weight: 600;
            color: #334155;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 9px;
            font-size: 14px;
            color: #0f172a;
            background: #fff;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .gender-options {
            display: flex;
            align-items: center;
            gap: 24px;
            min-height: 44px;
        }

        .gender-options label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: normal;
            cursor: pointer;
        }

        .gender-options input {
            width: auto;
            accent-color: #2563eb;
        }

        .file-input {
            padding: 10px;
            background: #f8fafc;
            border-style: dashed;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            padding: 8px 0 20px;
        }

        button {
            padding: 13px 26px;
            border-radius: 9px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            border: none;
        }

        .reset-btn {
            background: #e2e8f0;
            color: #334155;
        }

        .submit-btn {
            background: #2563eb;
            color: #fff;
        }

        .submit-btn:hover {
            background: #1d4ed8;
        }

        .reset-btn:hover {
            background: #cbd5e1;
        }

        @media (max-width: 600px) {
            body {
                padding: 24px 12px;
            }

            .form-card {
                padding: 20px 16px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .page-header h1 {
                font-size: 25px;
            }

            .form-group.full-width {
                grid-column: auto;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .form-actions button {
                width: 100%;
            }
        }
        .error-message {
    background: #fef2f2;
    color: #b91c1c;
    border: 1px solid #fecaca;
    border-left: 5px solid #dc2626;
    padding: 15px 18px;
    border-radius: 10px;
    margin-bottom: 22px;
    font-size: 14px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
}

.error-icon {
    font-size: 20px;
    font-weight: bold;
}
    </style>
</head>

<body>

<div class="container">

    <header class="page-header">
        <h1>Student Registration</h1>
        <p>Complete the form below to register a new student.</p>
    </header>

    <form action="" method="POST" enctype="multipart/form-data">

        <!-- Personal Information -->
        <section class="form-card">

            <div class="section-header">
                <div class="section-number">01</div>
                <div>
                    <h2>Personal Information</h2>
                    <p>Basic details about the student</p>
                </div>
            </div>

            <div class="form-grid">

                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" name="full_name"
                           id="full_name" placeholder="Enter full name" >
                </div>

                <div class="form-group">
                    <label for="place_of_birth">Place of Birth</label>
                    <input type="text" name="place_of_birth"
                           id="place_of_birth" placeholder="Enter place of birth">
                </div>

                <div class="form-group">
                    <label for="date_of_birth">Date of Birth</label>
                    <input type="date" name="date_of_birth"
                           id="date_of_birth" >
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address"
                           id="address" placeholder="Enter home address">
                </div>

                <div class="form-group">
                    <label>Gender</label>
                    <div class="gender-options">
                        <label>
                            <input type="radio" name="gender" value="male" >
                            Male
                        </label>
                        <label>
                            <input type="radio" name="gender" value="female">
                            Female
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone_number">Phone Number</label>
                    <input type="tel" name="phone_number"
                           id="phone_number" placeholder="Enter phone number">
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email"
                           id="email" placeholder="example@email.com">
                </div>

                <div class="form-group">
                    <label for="student_profile_picture">
                        Student Profile Picture
                    </label>
                    <input class="file-input" type="file"
                           name="student_profile_picture"
                           id="student_profile_picture"
                           accept="image/*">
                </div>

            </div>
        </section>

        <!-- Parent Information -->
        <section class="form-card">

            <div class="section-header">
                <div class="section-number">02</div>
                <div>
                    <h2>Parent Information</h2>
                    <p>Contact details of the parent or guardian</p>
                </div>
            </div>

            <div class="form-grid">

                <div class="form-group">
                    <label for="parent_name">Parent Name</label>
                    <input type="text" name="parent_name"
                           id="parent_name" placeholder="Enter parent name">
                </div>

                <div class="form-group">
                    <label for="parent_phone_number">Parent Phone Number</label>
                    <input type="tel" name="parent_phone_number"
                           id="parent_phone_number"
                           placeholder="Enter parent phone number">
                </div>

                <div class="form-group">
                    <label for="relationship_with_student">
                        Relationship with Student
                    </label>
                    <input type="text" name="relationship_with_student"
                           id="relationship_with_student"
                           placeholder="e.g. Father, Mother, Guardian">
                </div>

            </div>
        </section>

        <!-- Academic Information -->
        <section class="form-card">

            <div class="section-header">
                <div class="section-number">03</div>
                <div>
                    <h2>Academic Information</h2>
                    <p>Student identification and enrollment details</p>
                </div>
            </div>

            <div class="form-grid">

                <div class="form-group">
                    <label for="student_id">Student ID</label>
                    <input type="text" name="student_id"
                           id="student_id" placeholder="Enter student ID">
                </div>

                <div class="form-group">
                    <label for="faculty">Faculty</label>
                    <input type="text" name="faculty"
                           id="faculty" placeholder="Enter faculty">
                </div>

                <div class="form-group">
                    <label for="department">Department</label>
                    <input type="text" name="department"
                           id="department" placeholder="Enter department">
                </div>

                <div class="form-group">
                    <label for="class">Class</label>
                    <input type="text" name="class"
                           id="class" placeholder="Enter class">
                </div>

                <div class="form-group">
                    <label for="year_of_registration">
                        Year of Registration
                    </label>
                    <input type="number" name="year_of_registration"
                           id="year_of_registration"
                           placeholder="e.g. 2026" min="1900" max="2100">
                </div>

            </div>
        </section>

        <div class="form-actions">
            <button type="reset" class="reset-btn">Clear Form</button>
            <button type="submit" name="register" class="submit-btn">Submit Registration</button>
        </div>

    </form>
</div>


</body>
</html>
