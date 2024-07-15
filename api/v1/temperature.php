
<?php
$body = file_get_contents("php://input");

file_put_contents('log.txt', $body, FILE_APPEND);

$data = json_decode($body, true);

// Controleer of er data is ontvangen
if ($data !== null) 
{
    // Data is ontvangen, stuur de data als JSON response terug
    header('Content-Type: application/json');
    echo json_encode($data);
	//print_r($data);
} else 
{
    // Geen data ontvangen
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Geen geldige JSON data ontvangen.']);
	
}
?>
