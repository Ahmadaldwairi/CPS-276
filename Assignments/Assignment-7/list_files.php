<?php
require_once 'listFilesProc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List Files</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>List Files</h2>
    <a href="file_upload.php">Add File</a>
    <ul>
        <?php echo $output; ?>
    </ul>
</div>
</body>
</html>


