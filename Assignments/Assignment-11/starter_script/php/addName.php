<?php
require_once "../classes/Pdo_methods.php";

$data = json_decode(file_get_contents("php://input"), true);
$response = [];
$pdo = new PdoMethods();

// Validate name
if (!isset($data['name']) || trim($data['name']) === "") {
    $response['masterstatus'] = "error";
    $response['msg'] = "You must enter a name";
    echo json_encode($response);
    exit();
}

// Split first and last name
$parts = explode(" ", trim($data['name']));
if (count($parts) !== 2) {
    $response['masterstatus'] = "error";
    $response['msg'] = "You must enter both first and last name";
    echo json_encode($response);
    exit();
}

$first = ucfirst(strtolower($parts[0]));
$last = ucfirst(strtolower($parts[1]));
$formattedName = "$last, $first";

// Insert into DB
$sql = "INSERT INTO names (name) VALUES (:name)";
$bindings = [[":name", $formattedName, "str"]];
$result = $pdo->otherBinded($sql, $bindings);

if ($result === "noerror") {
    $response['masterstatus'] = "success";
    $response['msg'] = "Name has been added";
} else {
    $response['masterstatus'] = "error";
    $response['msg'] = "Insert failed";
}

echo json_encode($response);
