<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Technologies Project</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="About.html">About</a></li>
                <li><a href="Data.php">Data</a></li>
				<li><a href="Grafiek.php">Grafiek</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section id="home">
            <h2>De temperatuur van de PYNQ Z2.</h2>
            <p>Deze grafiek laat de laatste 10 gemeten waardes zien.</p>
          
            <canvas id="temperatureChart"></canvas>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Web Technologies Project</p>
    </footer>

    <script>
        // Functie om de pagina na 30 seconden te vernieuwen
        function refreshPage() 
		{
            setTimeout(function() 
			{
                location.reload();
            }, 30000); // 30 seconden in milliseconden
        }

        // Roep de functie aan wanneer de pagina geladen is
        window.onload = function() 
		{
            refreshPage();
           
            fetchTemperatureChartData();
        };

        

        // Functie om temperatuurdata voor de grafiek op te halen en weer te geven
        function fetchTemperatureChartData() 
		{
            fetch('https://server-of-yinnis.pxl.bjth.xyz/api/v1/temperature.php')
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) 
					{
                        const recentData = data.slice(-10); // Laatste 10 records
                        const labels = recentData.map(entry => entry.install_date);
                        const temperatures = recentData.map(entry => entry.log_data);

                        const ctx = document.getElementById('temperatureChart').getContext('2d');
                        const temperatureChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Temperatuur (°C)',
                                    data: temperatures,
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    x: {
                                        display: true,
                                        title: {
                                            display: true,
                                            text: 'Datum'
                                        }
                                    },
                                    y: {
                                        display: true,
                                        title: {
                                            display: true,
                                            text: 'Temperatuur (°C)'
                                        },
                                        beginAtZero: false
                                    }
                                }
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error('Error fetching temperature chart data:', error);
                });
        }

    </script>
</body>
</html>
