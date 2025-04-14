<?php

function getWeather($zip) {
    $acknowledgement = "";
    $output = "";

    if (empty($zip)) {
        $acknowledgement = "No zip code provided. Please enter a zip code.";
        return [$acknowledgement, $output];
    }

    $url = "https://russet-v8.wccnet.edu/~sshaper/assignments/assignment10_rest/get_weather_json.php?zip_code=" . urlencode($zip);

    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0");

    $response = curl_exec($ch);

    if ($response === false) {
        $acknowledgement = "There was an error retrieving the records.";
        curl_close($ch);
        return [$acknowledgement, $output];
    }

    curl_close($ch);

    $data = json_decode($response, true);

    if (isset($data['error'])) {
        $acknowledgement = $data['error'];
        return [$acknowledgement, $output];
    }

    // Display city weather
    $cityName = htmlspecialchars($data['searched_city']['name']);
    $output .= "<h2 class='mb-3'>Weather in $cityName</h2>";
    $output .= "<p><strong>Temperature:</strong> " . $data['searched_city']['temperature'] . "</p>";
    $output .= "<p><strong>Humidity:</strong> " . htmlspecialchars($data['searched_city']['humidity']) . "</p>";

    // 3-Day Forecast
    $output .= "<h4 class='mt-4'>3-Day Forecast</h4>";
    $output .= "<ul class='mb-4 ps-3'>";
    foreach ($data['searched_city']['forecast'] as $day) {
        $output .= "<li>" . htmlspecialchars($day['day']) . ": " . htmlspecialchars($day['condition']) . "</li>";
    }
    $output .= "</ul>";

    // Higher Temperatures
    $output .= "<h4>Up to three cities where temperatures are higher than $cityName</h4>";
    if (!empty($data['higher_temperatures'])) {
        $output .= "<table class='table table-bordered table-striped mb-4'><thead><tr><th>City</th><th>Temperature</th></tr></thead><tbody>";
        foreach ($data['higher_temperatures'] as $city) {
            $output .= "<tr><td>" . htmlspecialchars($city['name']) . "</td><td>" . $city['temperature'] . "</td></tr>";
        }
        $output .= "</tbody></table>";
    } else {
        $output .= "<div class='alert alert-info'>There are no cities with temperatures higher than $cityName.</div>";
    }

    // Lower Temperatures
    $output .= "<h4>Up to three cities where temperatures are lower than $cityName</h4>";
    if (!empty($data['lower_temperatures'])) {
        $output .= "<table class='table table-bordered table-striped'><thead><tr><th>City</th><th>Temperature</th></tr></thead><tbody>";
        foreach ($data['lower_temperatures'] as $city) {
            $output .= "<tr><td>" . htmlspecialchars($city['name']) . "</td><td>" . $city['temperature'] . "</td></tr>";
        }
        $output .= "</tbody></table>";
    } else {
        $output .= "<div class='alert alert-info'>There are no cities with temperatures lower than $cityName.</div>";
    }

    return [$acknowledgement, $output];
}
