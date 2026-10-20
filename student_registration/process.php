
<?php
// Student Registration System - process.php

function clean($value)
{
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function showError($message)
{
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registration Error</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background: #f1f5f9;
                padding: 30px;
            }
            .box {
                max-width: 600px;
                margin: 40px auto;
                background: white;
                padding: 25px;
                border-radius: 12px;
                box-shadow: 0 4px 15px #0001;
            }
            h2 { color: #dc2626; }
            a { color: #2563eb; }
        </style>
    </head>
    <body>
        <div class="box">
            <h2>Registration Error</h2>
            <p><?= clean($message) ?></p>
            <a href="index.html">Go Back to Form</a>
        </div>
    </body>
    </html>
    <?php
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.html');
    exit;
}

// Accept different possible input names from index.html.
$fieldAliases = [
    'full_name' => ['full_name', 'name', 'student_name', 'fullname'],
    'pob' => ['pob', 'place_of_birth', 'birth_place'],
    'dob' => ['dob', 'date_of_birth', 'birth_date'],
    'address' => ['address', 'student_address'],
    'gender' => ['gender', 'sex'],
    'telephone' => ['telephone', 'phone', 'student_phone'],
    'email' => ['email', 'student_email'],
    'parent_name' => ['parent_name', 'father_name', 'guardian_name'],
    'parent_telephone' => ['parent_telephone', 'parent_phone', 'guardian_phone'],
    'relationship' => ['relationship', 'parent_relationship'],
    'student_id' => ['student_id', 'studentid', 'id'],
    'faculty' => ['faculty'],
    'department' => ['department'],
    'class' => ['class', 'class_name', 'class_section'],
    'registration_date' => ['registration_date', 'reg_date']
];

$labels = [
    'full_name' => 'Full Name',
    'pob' => 'Place of Birth',
    'dob' => 'Date of Birth',
    'address' => 'Address',
    'gender' => 'Gender',
    'telephone' => 'Telephone',
    'email' => 'Email',
    'parent_name' => 'Parent Name',
    'parent_telephone' => 'Parent Telephone',
    'relationship' => 'Relationship',
    'student_id' => 'Student ID',
    'faculty' => 'Faculty',
    'department' => 'Department',
    'class' => 'Class',
    'registration_date' => 'Registration Date'
];

$data = [];

foreach ($fieldAliases as $key => $aliases) {
    $value = '';

    foreach ($aliases as $alias) {
        if (isset($_POST[$alias]) && is_string($_POST[$alias])) {
            $value = trim($_POST[$alias]);

            if ($value !== '') {
                break;
            }
        }
    }

    if ($value === '') {
        showError($labels[$key] . ' is required.');
    }

    $data[$key] = $value;
}

// Validate name.
if (!preg_match("/^[\p{L}\s'-]+$/u", $data['full_name'])) {
    showError('Full Name must contain letters only.');
}

// Validate email.
if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    showError('Please enter a valid email address.');
}

// Check uploaded image.
if (!isset($_FILES['image']) || !is_array($_FILES['image'])) {
    showError('Image field is missing. Make sure the input uses name="image".');
}

$image = $_FILES['image'];

if ($image['error'] !== UPLOAD_ERR_OK) {
    $uploadErrors = [
        UPLOAD_ERR_INI_SIZE => 'Image exceeds the server upload limit.',
        UPLOAD_ERR_FORM_SIZE => 'Image is too large.',
        UPLOAD_ERR_PARTIAL => 'Image upload was incomplete. Try again.',
        UPLOAD_ERR_NO_FILE => 'Please select an image.',
        UPLOAD_ERR_NO_TMP_DIR => 'Server temporary upload folder is missing.',
        UPLOAD_ERR_CANT_WRITE => 'Server cannot write the uploaded image.',
        UPLOAD_ERR_EXTENSION => 'A server extension stopped the upload.'
    ];

    showError(
        $uploadErrors[$image['error']]
        ?? 'Image upload failed. Please try again.'
    );
}

if (
    empty($image['tmp_name']) ||
    !is_uploaded_file($image['tmp_name'])
) {
    showError('The uploaded image could not be verified.');
}

// Maximum image size: 2 MB.
if ($image['size'] <= 0 || $image['size'] > 2 * 1024 * 1024) {
    showError('Image must be smaller than 2 MB.');
}

// Verify the actual image type.
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mimeType = $finfo->file($image['tmp_name']);

$allowedTypes = [
    'image/png' => 'png',
    'image/jpeg' => 'jpg',
    'image/gif' => 'gif'
];

if (!isset($allowedTypes[$mimeType])) {
    showError('Only PNG, JPG, JPEG and GIF images are allowed.');
}

// Verify that the file is a real image.
$imageInfo = getimagesize($image['tmp_name']);

if ($imageInfo === false) {
    showError('The selected file is not a valid image.');
}

// Create uploads folder if necessary.
$uploadDir = __DIR__ . DIRECTORY_SEPARATOR . 'uploads';

if (!is_dir($uploadDir)) {
    if (!mkdir($uploadDir, 0755, true) && !is_dir($uploadDir)) {
        showError('Cannot create uploads folder.');
    }
}

if (!is_writable($uploadDir)) {
    showError('The uploads folder is not writable.');
}

// Generate a unique filename.
$extension = $allowedTypes[$mimeType];
$imageName = 'student_' . bin2hex(random_bytes(8)) . '.' . $extension;
$destination = $uploadDir . DIRECTORY_SEPARATOR . $imageName;

if (!move_uploaded_file($image['tmp_name'], $destination)) {
    showError('Could not save the image. Check the uploads folder.');
}

$imagePath = 'uploads/' . $imageName;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Result</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
            margin: 0;
            padding: 25px;
        }

        .container {
            max-width: 850px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 20px #0001;
        }

        h1 {
            text-align: center;
            color: #15803d;
        }

        h2 {
            color: #1d4ed8;
            margin-top: 28px;
            border-bottom: 1px solid #dbeafe;
            padding-bottom: 8px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 14px;
            text-align: center;
            border-radius: 8px;
        }

        .student-image {
            text-align: center;
            margin: 22px;
        }

        .student-image img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
            border: 3px solid #dbeafe;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            border: 1px solid #e2e8f0;
            padding: 11px;
            overflow-wrap: anywhere;
        }

        td:first-child {
            width: 35%;
            font-weight: bold;
            background: #f8fafc;
        }

        .back {
            display: inline-block;
            margin-top: 25px;
            background: #2563eb;
            color: white;
            padding: 12px 18px;
            text-decoration: none;
            border-radius: 7px;
        }

        @media (max-width: 600px) {
            body { padding: 10px; }
            .container { padding: 15px; }
            td { padding: 8px; }
        }
    </style>
</head>

<body>
<div class="container">

    <h1>Registration Successful!</h1>

    <p class="success">
        Student information and image uploaded successfully.
    </p>

    <div class="student-image">
        <img src="<?= clean($imagePath) ?>" alt="Student Image">
        <p><strong><?= clean($data['full_name']) ?></strong></p>
    </div>

    <h2>Personal Information</h2>
    <table>
        <tr><td>Full Name</td><td><?= clean($data['full_name']) ?></td></tr>
        <tr><td>Place of Birth</td><td><?= clean($data['pob']) ?></td></tr>
        <tr><td>Date of Birth</td><td><?= clean($data['dob']) ?></td></tr>
        <tr><td>Address</td><td><?= nl2br(clean($data['address'])) ?></td></tr>
        <tr><td>Gender</td><td><?= clean($data['gender']) ?></td></tr>
        <tr><td>Telephone</td><td><?= clean($data['telephone']) ?></td></tr>
        <tr><td>Email</td><td><?= clean($data['email']) ?></td></tr>
    </table>

    <h2>Parent Information</h2>
    <table>
        <tr><td>Parent Name</td><td><?= clean($data['parent_name']) ?></td></tr>
        <tr><td>Parent Telephone</td><td><?= clean($data['parent_telephone']) ?></td></tr>
        <tr><td>Relationship</td><td><?= clean($data['relationship']) ?></td></tr>
    </table>

    <h2>Academic Information</h2>
    <table>
        <tr><td>Student ID</td><td><?= clean($data['student_id']) ?></td></tr>
        <tr><td>Faculty</td><td><?= clean($data['faculty']) ?></td></tr>
        <tr><td>Department</td><td><?= clean($data['department']) ?></td></tr>
        <tr><td>Class</td><td><?= clean($data['class']) ?></td></tr>
        <tr><td>Registration Date</td><td><?= clean($data['registration_date']) ?></td></tr>
        <tr><td>Image Filename</td><td><?= clean($imageName) ?></td></tr>
    </table>

    <a class="back" href="index.html">Register Another Student</a>

</div>
</body>
</html>
