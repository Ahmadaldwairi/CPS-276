<?php
require_once 'PdoMethods.php';

$output = "";
$targetDir = "files/";

if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['userFile'])) {

    if ($_FILES['userFile']['error'] === UPLOAD_ERR_OK) {
        $fileName = $_POST['fileName'] ?? '';
        $originalFileName = basename($_FILES['userFile']['name']);
        $fileType = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));
        $fileSize = $_FILES['userFile']['size'];
        $tempFile = $_FILES['userFile']['tmp_name'];

        $uniqueFileName = uniqid() . '_' . $originalFileName;
        $targetFile = $targetDir . $uniqueFileName;

        if (empty($fileName)) {
            $output = "<div class='alert alert-danger'>Error: Please enter a file name.</div>";
        } elseif ($fileType !== "pdf") {
            $output = "<div class='alert alert-danger'>Error: Only PDF files are allowed.</div>";
        } elseif ($fileSize > 100000) {
            $output = "<div class='alert alert-danger'>Error: File size must be under 100KB.</div>";
        } elseif (move_uploaded_file($tempFile, $targetFile)) {
            $pdo = new PdoMethods();

            $sql = "INSERT INTO pdf_files (file_name, file_path) VALUES (:fileName, :filePath)";
            $bindings = [
                [':fileName', $fileName, 'str'],
                [':filePath', $targetFile, 'str']
            ];

            $result = $pdo->otherBinded($sql, $bindings);

            if ($result === 'noerror') {
                $output = "<div class='alert alert-success'>File successfully uploaded.</div>";
            } else {
                $output = "<div class='alert alert-danger'>Error: Could not save to database.</div>";
            }
        } else {
            $output = "<div class='alert alert-danger'>Error: Failed to move uploaded file.</div>";
        }

    } else {
        $uploadErrors = [
            UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize directive.",
            UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive.",
            UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
            UPLOAD_ERR_NO_FILE => "No file was uploaded.",
            UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
            UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
            UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload."
        ];

        $errorMessage = $uploadErrors[$_FILES['userFile']['error']] ?? "Unknown upload error.";
        $output = "<div class='alert alert-danger'>Error: " . $errorMessage . "</div>";
    }
}
?>

