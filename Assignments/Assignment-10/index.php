<?php
$output = "";
$acknowledgement = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once 'php/rest_client.php';
    $result = getWeather($_POST['zip_code']);

    $acknowledgement = $result[0];
    $output = $result[1];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weather Lookup</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="text-center mb-4">City Weather Lookup</h1>

        <?php if (!empty($acknowledgement)) { echo "<div class='alert alert-warning text-center'>$acknowledgement</div>"; } ?>

        <form action="index.php" method="post" class="mb-5">
            <div class="mb-3">
                <label for="zip_code" class="form-label">Enter Zip Code</label>
                <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="e.g., 12345" value="<?php echo isset($_POST['zip_code']) ? htmlspecialchars($_POST['zip_code']) : ''; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Get Weather</button>
        </form>

        <!-- Weather Output -->
        <?php if (!empty($output)) { echo $output; } ?>
    </div>
</body>
</html>
