
<?php
if (isset($_POST['upload']) && isset($_FILES['myfile'])) {

    $file = $_FILES['myfile'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        exit("File upload failed!");
    }

    if ($file['size'] > 20 * 1024 * 1024) {
        exit("File is too large! Maximum 20MB.");
    }

    $folder = __DIR__ . '/uploads/';

    if (!is_dir($folder)) {
        mkdir($folder, 0755, true);
    }

    $originalName = basename($file['name']);
    $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

    // Oggolow sawirrada oo keliya in browser-ka la tuso
    $imageTypes = [
        'jpg'  => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png'  => 'image/png',
        'gif'  => 'image/gif',
        'webp' => 'image/webp'
    ];

    $isImage = isset($imageTypes[$ext]);

    // Hubi nooca dhabta ah ee file-ka
    $mime = mime_content_type($file['tmp_name']);

    if ($isImage &&
        (!isset($imageTypes[$ext]) ||
         $mime !== $imageTypes[$ext])) {
        exit("Invalid image file!");
    }

    $newName = bin2hex(random_bytes(16));

    if ($ext !== '') {
        $newName .= '.' . $ext;
    }

    $destination = $folder . $newName;

    if (move_uploaded_file($file['tmp_name'], $destination)) {

        echo "<h2>Uploaded File Information</h2>";

        echo "File Name: " .
            htmlspecialchars($originalName, ENT_QUOTES, 'UTF-8') .
            "<br>";

        echo "File Size: " .
            number_format($file['size'] / 1024, 2) . " KB<br>";

        if ($isImage && getimagesize($destination)) {
            echo "<h3>Your Uploaded Image:</h3>";

            echo "<img src='uploads/" .
                rawurlencode($newName) .
                "' alt='Uploaded Image'
                style='max-width:500px;width:100%;height:auto;'>";

        } elseif (!$isImage && $ext === 'txt') {
            echo "<h3>File Content:</h3><pre>" .
                htmlspecialchars(
                    file_get_contents($destination),
                    ENT_QUOTES,
                    'UTF-8'
                ) .
                "</pre>";
        }

        echo "<h2>Upload Successful!</h2>";
        echo "<a href='home.php'>Upload Another File</a>";

    } else {
        echo "Upload failed!";
    }
} else {
    echo "Please select a file first.";
}
?>
