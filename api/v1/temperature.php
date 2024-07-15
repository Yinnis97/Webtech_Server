<?php
$logfile = __DIR__ . '/log.txt'; // Plaats log.txt in dezelfde directory als dit script

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $body = file_get_contents("php://input");

    // Log the raw input to check what is being received
    if (file_put_contents($logfile, $body . PHP_EOL, LOCK_EX) === false) {
        error_log("Failed to write to log file: " . $logfile);
    }
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
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Lees de inhoud van log.txt en verstuur deze als JSON
    if (file_exists($logfile)) {
        $logContent = file_get_contents($logfile);
        $logEntries = explode(PHP_EOL, $logContent);
        $jsonArray = [];

        foreach ($logEntries as $entry) {
            if (!empty($entry)) {
                $jsonArray[] = $entry;
            }
        }

        header('Content-Type: application/json');
        echo json_encode($jsonArray);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Het logbestand bestaat niet.']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Wis de inhoud van het logbestand
    if (file_exists($logfile)) {
        if (file_put_contents($logfile, '') !== false) {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Logbestand is gewist.']);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Kon logbestand niet wissen.']);
        }
    } else {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Het logbestand bestaat niet.']);
    }
} else {
    // Als de request methode niet POST, GET of DELETE is
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Ongeldige verzoeksmethode.']);
}
?>
