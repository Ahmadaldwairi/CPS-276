<?php
require_once 'classes/Date_time.php';
$dt = new Date_time();
$output = $dt->checkSubmit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Note</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Add Note</h2>
    <a href="displayNotes.php">Display Notes</a>
    <form method="POST">
        <?= $output ?>
        <label for="dateTime">Date and Time</label>
        <input type="datetime-local" class="form-control" name="dateTime" id="dateTime">

        <label for="note" class="mt-3">Note</label>
        <textarea class="form-control" name="note" id="note" rows="6"></textarea>

        <button type="submit" name="addNote" class="btn btn-primary mt-3">Add Note</button>
    </form>
</body>
</html>
