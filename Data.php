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
	        <p>De temperatuur van de PYNQ wordt ongeveer elke minut gemeten en verstuurd naar de API.</p>
			
            <div id="receivedData">
                Data wordt hier weergegeven...
            </div>
			
            <button id="deleteDataBtn">Verwijder data</button>

<script>
                // Haal de ontvangen data op via een Fetch request
                fetch('https://server-of-yinnis.pxl.bjth.xyz/api/v1/temperature.php')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        const dataContainer = document.getElementById('receivedData');
                        dataContainer.innerHTML = '';

                        // Controleer of er een foutmelding in de data zit
                        if (data.error) 
						{
                            // Toon de foutmelding
                            const errorDiv = document.createElement('div');
                            errorDiv.className = 'error';
                            errorDiv.textContent = `Error: ${data.error}`;
                            dataContainer.appendChild(errorDiv);
                        } 
						else 
						{
                            // Loop door de ontvangen JSON data en toon deze
                            data.forEach(entry => 
							{
                                const entryDiv = document.createElement('div');
                                entryDiv.className = 'log-entry';
                                entryDiv.textContent = entry;
                                dataContainer.appendChild(entryDiv);
                            });
							
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        const dataContainer = document.getElementById('receivedData');
                        dataContainer.innerHTML = '<div style="color: red;">Er is een fout opgetreden bij het ophalen van de data.</div>';
                    });
</script>

<script>
    document.getElementById('deleteDataBtn').addEventListener('click', function() {
        fetch('https://server-of-yinnis.pxl.bjth.xyz/api/v1/temperature.php', {
            method: 'DELETE'
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Toon een bevestiging aan de gebruiker dat de data verwijderd is
            alert('Data succesvol verwijderd!');
            // Vernieuw de pagina om de laatste data te tonen
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Er is een fout opgetreden bij het verwijderen van de data.');
        });
    });
</script>

        </section>
    </main>

    <footer>
        <p>&copy; 2024 Web Technologies Project</p>
    </footer>
</body>
</html>