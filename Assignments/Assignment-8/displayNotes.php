<?php
require_once 'classes/Date_time.php';
$dt = new Date_time();
$notes = $dt->checkSubmit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Display Notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h1>Display Notes</h1>
    <a href="addNote.php">Add Note</a>

    <form method="post" class="mt-3">
        <div class="mb-3">
            <label for="begDate" class="form-label">Beginning Date</label>
            <input type="date" class="form-control" id="begDate" name="begDate">
        </div>

        <div class="mb-3">
            <label for="endDate" class="form-label">Ending Date</label>
            <input type="date" class="form-control" id="endDate" name="endDate">
        </div>

        <button type="submit" name="getNotes" class="btn btn-primary">Get Notes</button>
    </form>
    <div class="mt-4">
        <?= $notes ?>
    </div>

</body>
</html>

