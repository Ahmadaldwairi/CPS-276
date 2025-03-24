<?php
require_once 'PdoMethods.php';

$pdo = new PdoMethods();
$sql = "SELECT file_name, file_path FROM pdf_files";
$records = $pdo->selectNotBinded($sql);

$output = "";

if ($records === 'error') {
    $output = "<li>Error retrieving files.</li>";
} elseif (count($records) === 0) {
    $output = "<li>No files found.</li>";
} else {
    foreach ($records as $row) {
        $output .= "<li><a target='_blank' href='{$row['file_path']}'>" . htmlspecialchars($row['file_name']) . "</a></li>";
    }
}
?>

