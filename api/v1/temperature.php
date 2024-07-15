<?php
$body = file_get_contents("php://input");

$data = json_decode($body, true);

// Controleer of er data is ontvangen
if ($data !== null) {
    // Data is ontvangen, print de data
    
    print_r($data);
    
} else {
    // Geen data ontvangen
    echo 'Geen geldige JSON data ontvangen.';
	print_r($data);
}
?>