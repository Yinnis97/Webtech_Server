<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE, POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

//soms wordt er eerst een OPTIONS req gestuurd om te checken of de server wel POST GET etc accepteerd 
//Zo ja dan stuurt de server code 204 terug.
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') 
{
    http_response_code(204);
    exit();
}

$host = 'localhost';
$db = 'yinnis';
$user = 'yinnis';
$pass = 'webtech';

$dsn = "pgsql:host=$host;dbname=$db";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try 
{
    $pdo = new PDO($dsn, $user, $pass, $options);
} 
catch (\PDOException $e) 
{
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $input = json_decode(file_get_contents('php://input'), true);
    if (isset($input['temperature'])) 
	{
        $temperature = $input['temperature'];
        
        // Huidige datum en tijd in UTC
        $currentDateTimeUTC = gmdate('Y-m-d H:i:s');

        // Voeg 2 uur toe (7200 seconden) aan de UTC tijd om naar Europe/Brussels tijd te verschuiven
        $currentDateTimeBrussels = date('Y-m-d H:i:s', strtotime($currentDateTimeUTC . ' +2 hours'));

        // Voorbereiden van de SQL-query om de temperatuur, datum en tijd in de database op te slaan
        $sql = 'INSERT INTO log_table (log_data, install_date) VALUES (:temperature, :currentDateTime)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['temperature' => $temperature, 'currentDateTime' => $currentDateTimeBrussels]);

        echo json_encode(['status' => 'success', 'message' => 'Temperature and date logged successfully']);
    } 
	else 
	{
        echo json_encode(['error' => 'Temperature not provided']);
    }
} 

elseif ($_SERVER['REQUEST_METHOD'] === 'GET') 
{
    $sql = 'SELECT * FROM log_table';
    $stmt = $pdo->query($sql);
    $data = $stmt->fetchAll();
    echo json_encode($data);
} 

elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') 
{
    try 
	{
        // Delete row with maximum equip_id
        $sql = 'DELETE FROM log_table WHERE equip_id = (SELECT MAX(equip_id) FROM log_table)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        echo json_encode(['status' => 'success', 'message' => 'Last temperature data deleted successfully']);
    } 
	catch (\PDOException $e) 
	{
        http_response_code(500); // Set HTTP response code 500
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
}

else 
{
    // Als de request methode niet POST, GET of DELETE is
    echo json_encode(['error' => 'Ongeldige verzoeksmethode.']);
}

?>


