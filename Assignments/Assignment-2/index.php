<?php
// array from 1 to 50
$numbers = range(1, 50);
$evenNumbersArray = [];

// even numbers
foreach ($numbers as $number) {
    if ($number % 2 == 0) {
        $evenNumbersArray[] = $number;
    }
}

// array into a string with " - " separator
$evenNumbers = "Even Numbers: " . implode(" - ", $evenNumbersArray);

// form using a heredoc
$form = <<<EOD
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" placeholder="name@example.com">
    </div>
    <div class="mb-3">
        <label for="textarea" class="form-label">Example textarea</label>
        <textarea class="form-control" id="textarea" rows="3"></textarea>
    </div>
EOD;

// Func to create a bootstrap table 
function createTable($rows, $columns) {
    $table = '<table class="table table-bordered">';
    for ($i = 1; $i <= $rows; $i++) {
        $table .= '<tr>';
        for ($j = 1; $j <= $columns; $j++) {
            $table .= "<td>Row $i, Col $j</td>";
        }
        $table .= '</tr>';
    }
    $table .= '</table>';
    return $table;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Table & Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <?php
        echo "<p>$evenNumbers</p>";
        echo $form;
        echo createTable(8, 6);
    ?>
</body>
</html>


