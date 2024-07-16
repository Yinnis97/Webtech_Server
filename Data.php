<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Technologies Project</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="About.html">About</a></li>
                <li><a href="data.php">Data</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section id="home">
            <h2>De temperatuur van de PYNQ Z2.</h2>
            <p>De temperatuur van de PYNQ wordt ongeveer elke minuut gemeten en verstuurd naar de API.</p>
            <div id="temperature-data">
                <p>Loading temperature data...</p>
            </div>
            <button onclick="deleteLastTemperature()">Delete Last Temperature Data</button>

        </section>
    </main>
    <footer>
        <p>&copy; 2024 Web Technologies Project</p>
    </footer>

    <script>
        // Functie om de pagina na 30 seconden te vernieuwen
        function refreshPage() {
            setTimeout(function() {
                location.reload();
            }, 30000); // 30 seconden in milliseconden
        }

        // Roep de functie aan wanneer de pagina geladen is
        window.onload = function() {
            refreshPage();
            fetchTemperatureData();
        };

        // Functie om temperatuurdata op te halen en weer te geven
        function fetchTemperatureData() {
            fetch('https://server-of-yinnis.pxl.bjth.xyz/api/v1/temperature.php')
                .then(response => response.json())
                .then(data => {
                    const temperatureDataDiv = document.getElementById('temperature-data');
                    if (data.length > 0) {
                        const latestData = data[data.length - 1]; // Laatste record
                        temperatureDataDiv.innerHTML = `<p>Temperatuur: ${latestData.log_data} &#8451;</p>
                                                        <p>Datum: ${latestData.install_date}</p>`;
                    } else {
                        temperatureDataDiv.innerHTML = '<p>Geen temperatuurdata beschikbaar.</p>';
                    }
                })
                .catch(error => {
                    console.error('Error fetching temperature data:', error);
                    document.getElementById('temperature-data').innerHTML = '<p>Error fetching temperature data.</p>';
                });
        }

	function deleteLastTemperature() {
    fetch('https://server-of-yinnis.pxl.bjth.xyz/api/v1/temperature.php', {
        method: 'DELETE'
    })
    .then(response => response.json())
    .then(data => {
        console.log(data); // Voor debugging, kun je dit aanpassen afhankelijk van wat je wilt laten zien
        fetchTemperatureData(); // Vernieuw de temperatuurdata na verwijdering
    })
    .catch(error => {
        console.error('Error deleting temperature data:', error);
        // Toon een foutmelding aan de gebruiker als er iets misgaat
    });
    }

    </script>

	
</body>
</html>
