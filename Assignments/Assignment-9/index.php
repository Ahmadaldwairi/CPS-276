<?php
require_once 'classes/Pdo_methods.php';
require_once 'classes/StickyForm.php';
require_once 'classes/Validation.php';

$pdo = new PdoMethods();
$stickyForm = new StickyForm();
$validator = new Validation();

$formElements = [
  "firstName" => "", "lastName" => "", "email" => "",
  "password" => "", "confirmPassword" => "",
  "firstNameError" => "", "lastNameError" => "", "emailError" => "",
  "passwordError" => "", "confirmPasswordError" => "", "formMsg" => ""
];

if (isset($_POST['register'])) {
  $formElements = $stickyForm->validateForm($_POST);

  if ($formElements['formMsg'] === "valid") {
    $sql = "SELECT email FROM users WHERE email = :email";
    $bindings = [ [':email', $_POST['email'], 'str'] ];
    $records = $pdo->selectBinded($sql, $bindings);

    if ($records === 'error') {
      $formElements['formMsg'] = "Database error.";
    } elseif (count($records) > 0) {
      $formElements['formMsg'] = "There is already a record with that email";
    } else {
      $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $sql = "INSERT INTO users (first_name, last_name, email, password) 
              VALUES (:fname, :lname, :email, :password)";
      $bindings = [
        [':fname', $_POST['firstName'], 'str'],
        [':lname', $_POST['lastName'], 'str'],
        [':email', $_POST['email'], 'str'],
        [':password', $hashedPassword, 'str']
      ];

      $result = $pdo->otherBinded($sql, $bindings);
      if ($result === 'error') {
        $formElements['formMsg'] = "Error inserting record.";
      } else {
        $formElements = array_map(fn() => "", $formElements);
        $formElements['formMsg'] = "You have been added to the database";
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h3 class="text-primary"><?= $formElements['formMsg'] ?></h3>
  <form method="post" class="row g-3">
    <div class="col-md-6">
      <label class="form-label">First Name</label>
      <input type="text" class="form-control" name="firstName" value="<?= $formElements['firstName'] ?>">
      <div class="text-danger"><?= $formElements['firstNameError'] ?></div>
    </div>

    <div class="col-md-6">
      <label class="form-label">Last Name</label>
      <input type="text" class="form-control" name="lastName" value="<?= $formElements['lastName'] ?>">
      <div class="text-danger"><?= $formElements['lastNameError'] ?></div>
    </div>

    <div class="col-md-6">
      <label class="form-label">Email</label>
      <input type="text" class="form-control" name="email" value="<?= $formElements['email'] ?>">
      <div class="text-danger"><?= $formElements['emailError'] ?></div>
    </div>

    <div class="col-md-6">
      <label class="form-label">Password</label>
      <input type="password" class="form-control" name="password">
      <div class="text-danger"><?= $formElements['passwordError'] ?></div>
    </div>

    <div class="col-md-6">
      <label class="form-label">Confirm Password</label>
      <input type="password" class="form-control" name="confirmPassword">
      <div class="text-danger"><?= $formElements['confirmPasswordError'] ?></div>
    </div>

    <div class="col-12">
      <button type="submit" name="register" class="btn btn-primary">Register</button>
    </div>
  </form>

  <hr class="my-4">

  <h5>Registered Users</h5>
  <?php
  $records = $pdo->selectNotBinded("SELECT * FROM users");

  if ($records !== 'error' && count($records) > 0) {
    echo "<table class='table table-bordered'><thead><tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Password</th></tr></thead><tbody>";
    foreach ($records as $row) {
      echo "<tr>
              <td>{$row['first_name']}</td>
              <td>{$row['last_name']}</td>
              <td>{$row['email']}</td>
              <td>{$row['password']}</td>
            </tr>";
    }
    echo "</tbody></table>";
  } else {
    echo "<p>No records to display.</p>";
  }
  ?>
</div>
</body>
</html>
