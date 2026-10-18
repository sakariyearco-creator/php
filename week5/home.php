
<!DOCTYPE html>
<html>
<head>
    <title>File Upload</title>
</head>
<body>
    <h2>Upload Your File</h2>

    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="myfile" required>
        <br><br>
        <button type="submit" name="upload">Upload File</button>
    </form>
</body>
</html>
