
<?php
$body = file_get_contents("php://input");

$data = json_decode($body, true);

// Controleer of er data is ontvangen
if ($data !== null) {
    // Data is ontvangen, stuur de data als JSON response terug
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    // Geen data ontvangen
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Geen geldige JSON data ontvangen.']);
}
?>
