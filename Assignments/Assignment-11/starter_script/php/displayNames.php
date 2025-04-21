<?php
require_once "../classes/Pdo_methods.php";

$pdo = new PdoMethods();
$sql = "SELECT name FROM names ORDER BY name";
$records = $pdo->selectNotBinded($sql);

$response = [];

if ($records === 'error') {
    $response['masterstatus'] = 'error';
    $response['msg'] = 'There was a problem retrieving the names.';
} else {
    $output = "";

    if (count($records) === 0) {
        $output = "<div>No names to display.</div>";
    } else {
        foreach ($records as $row) {
            $output .= "<div>" . htmlspecialchars($row['name']) . "</div>";
        }
    }

    $response['masterstatus'] = 'success';
    $response['names'] = $output;
}

echo json_encode($response);
