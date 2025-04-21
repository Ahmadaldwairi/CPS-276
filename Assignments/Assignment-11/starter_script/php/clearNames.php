<?php
require_once "../classes/Pdo_methods.php";

$response = [];
$pdo = new PdoMethods();

$sql = "DELETE FROM names";
$result = $pdo->otherNotBinded($sql);

if ($result === "noerror") {
    $response['masterstatus'] = "success";
    $response['msg'] = "All names have been cleared";
} else {
    $response['masterstatus'] = "error";
    $response['msg'] = "There was a problem deleting names";
}

echo json_encode($response);
