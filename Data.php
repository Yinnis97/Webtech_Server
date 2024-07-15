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
                <li><a href=index.html>Home</a></li>
                <li><a href=About.html>About</a></li>
                <li><a href=Data.php>Data</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section id="home">
<div id="receivedData">
  Data wordt hier weergegeven...
</div>

<script>
// Haal de ontvangen data op via een Fetch request
fetch('https://server-of-yinnis.pxl.bjth.xyz/api/v1/temperature.php')
  .then(response => response.json())
  .then(data => {
    // Toon de ontvangen data in de div met id 'receivedData'
    document.getElementById('receivedData').innerHTML = '<pre>' + JSON.stringify(data, null, 2) + '</pre>';
  })
  .catch(error => {
    console.error('Error:', error);
    document.getElementById('receivedData').innerHTML = '<div style="color: red;">Er is een fout opgetreden bij het ophalen van de data.</div>';
  });
</script>
        </section>
       
    </main>

    <footer>
      <p>&copy; 2024 Web Technologies Project</p>
    </footer>
    
</body>

</html>