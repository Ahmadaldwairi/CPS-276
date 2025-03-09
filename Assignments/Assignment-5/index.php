<?php
// Include the Directories class
require_once 'classes/Directories.php';

// Initialize message variable
$message = '';
$filePath = '';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $folderName = $_POST['folderName'] ?? '';
    $fileContent = $_POST['fileContent'] ?? '';
    
    // Create new Directories object
    $dirManager = new Directories();
    
    // Attempt to create directory and file
    $result = $dirManager->createDirectoryAndFile($folderName, $fileContent);
    
    // Handle result
    if ($result['success']) {
        $filePath = $result['path'];
    } else {
        $message = $result['message'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File and Directory Assignment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>File and Directory Assignment</h1>
        <p>Enter a folder name and the contents of a file. Folder names should contain alpha numeric characters only.</p>
        
        <?php if (!empty($message)): ?>
            <div class="alert alert-danger"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <?php if (!empty($filePath)): ?>
            <div class="mb-3">
                <a href="<?php echo $filePath; ?>" target="_blank">Path were file is located</a>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="mb-3">
                <label for="folderName" class="form-label">Folder Name</label>
                <input type="text" class="form-control" id="folderName" name="folderName" required>
            </div>
            
            <div class="mb-3">
                <label for="fileContent" class="form-label">File Content</label>
                <textarea class="form-control" id="fileContent" name="fileContent" rows="6" required></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>