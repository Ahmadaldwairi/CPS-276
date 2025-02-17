<?php
$output = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'processNames.php';
    $output = addClearNames();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Name Processor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h4 class="text-start mb-4">Add Names</h4>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="mb-3">
                        <button type="submit" name="action" value="add" class="btn btn-primary">Add Name</button>
                        <button type="submit" name="action" value="clear" class="btn btn-primary">Clear Names</button>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter Name">
                    </div>
                    <div class="mb-3">
                        <textarea style="height: 500px;" class="form-control" id="namelist" name="namelist"><?php echo $output ?></textarea>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

