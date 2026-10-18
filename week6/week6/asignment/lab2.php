<?php
session_start();

if (!isset($_SESSION["student"])) {
    header("Location: index.php");
    exit();
}

$student = $_SESSION["student"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            padding: 40px 16px;
            color: #1e293b;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 14px;
        }

        h1 {
            color: #15803d;
            margin-bottom: 10px;
        }

        p {
            margin-bottom: 20px;
            color: #64748b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #e2e8f0;
            padding: 12px;
            text-align: left;
            overflow-wrap: anywhere;
        }

        th {
            background: #dbeafe;
            width: 35%;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            background: #2563eb;
            color: white;
            padding: 12px 18px;
            border-radius: 8px;
            text-decoration: none;
        }
    </style>
</head>

<body>
<div class="container">

    <h1>Registration Successful!</h1>
    <p>The student information has been submitted successfully.</p>

    <table>
        <tr>
            <th>Field</th>
            <th>Submitted Information</th>
        </tr>

        <?php
        $fields = [
            "full_name" => "Full Name",
            "place_of_birth" => "Place of Birth",
            "date_of_birth" => "Date of Birth",
            "address" => "Address",
            "gender" => "Gender",
            "student_profile_picture" => "name of profile picture",
            "phone_number" => "Phone Number",
            "email" => "Email",
            "parent_name" => "Parent Name",
            "parent_phone_number" => "Parent Phone",
            "relationship_with_student" => "Relationship",
            "student_id" => "Student ID",
            "faculty" => "Faculty",
            "department" => "Department",
            "class" => "Class",
            "year_of_registration" => "Registration Year"
        ];

        foreach ($fields as $key => $label) {
            echo "<tr>";
            echo "<th>" . htmlspecialchars($label) . "</th>";
            echo "<td>" . htmlspecialchars($student[$key] ?? "") . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <a href="asignment4.php">Back to Registration</a>

</div>
</body>
</html>