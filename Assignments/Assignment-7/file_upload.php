<?php
require_once 'fileUploadProc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File Upload</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 30px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>File Upload</h1>
    <p><a href="list_files.php">Show File List</a></p>

    <?php echo $output; ?>

    <form method="POST" enctype="multipart/form-data" action="file_upload.php">
        <div class="form-group">
            <label for="fileName">File Name</label>
            <input type="text" class="form-control" name="fileName" id="fileName" required>
        </div>
        <div class="form-group">
            <label for="userFile">Choose PDF File</label>
            <input type="file" class="form-control-file" name="userFile" id="userFile" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload File</button>
    </form>
</div>
</body>
</html>
