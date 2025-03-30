<?php
require_once 'Db_conn.php';

class Date_time {
    private $pdo;

    public function __construct() {
        $db = new Db_conn();
        $this->pdo = $db->dbOpen();
    }

    public function checkSubmit() {
        $output = "";
        if (isset($_POST['addNote'])) {
            $dateTime = $_POST['dateTime'] ?? '';
            $note = trim($_POST['note'] ?? '');

            if (empty($dateTime) || empty($note)) {
                $output .= "<p class='text-danger'>Please enter a date, time, and note.</p>";
            } else {
                $timestamp = strtotime($dateTime);
                $sql = "INSERT INTO note (date_time, note) VALUES (:dateTime, :note)";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    ':dateTime' => date('Y-m-d H:i:s', $timestamp),
                    ':note' => $note
                ]);
                $output .= "<p class='text-success'>Note added successfully.</p>";
            }
        }
        if (isset($_POST['getNotes'])) {
            $begDate = $_POST['begDate'] ?? '';
            $endDate = $_POST['endDate'] ?? '';

            if (empty($begDate) || empty($endDate)) {
                $output .= "<p class='text-danger'>Please select both beginning and ending dates.</p>";
            } else {
                $begTimestamp = $begDate . " 00:00:00";
                $endTimestamp = $endDate . " 23:59:59";

                $sql = "SELECT date_time, note FROM note 
                        WHERE date_time BETWEEN :begDate AND :endDate 
                        ORDER BY date_time DESC";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    ':begDate' => $begTimestamp,
                    ':endDate' => $endTimestamp
                ]);
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($results) {
                    $output .= "<table class='table table-striped'>
                        <thead><tr><th>Date and Time</th><th>Note</th></tr></thead><tbody>";
                    foreach ($results as $row) {
                        $formattedDate = date("m/d/Y h:i a", strtotime($row['date_time']));
                        $output .= "<tr><td>{$formattedDate}</td><td>{$row['note']}</td></tr>";
                    }
                    $output .= "</tbody></table>";
                } else {
                    $output .= "<p class='text-info'>No notes found for that date range.</p>";
                }
            }
        }

        return $output;
    }
}
?>
