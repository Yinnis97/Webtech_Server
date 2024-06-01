const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');

const app = express();
const port = 3000;

app.use(bodyParser.json());

// Create a connection to the database
const db = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: 'yourpassword',
  database: 'game_scores'
});

db.connect(err => {
  if (err) {
    console.error('Error connecting to the database:', err);
    return;
  }
  console.log('Connected to the database.');
});

// API endpoint to save score
app.post('/save-score', (req, res) => {
  const { score } = req.body;
  const query = 'INSERT INTO scores (score) VALUES (?)';

  db.query(query, [score], (err, result) => {
    if (err) {
      console.error('Error saving score:', err);
      res.status(500).send('Error saving score');
      return;
    }
    res.status(200).send('Score saved successfully');
  });
});

app.listen(port, () => {
  console.log(`Server is running on http://localhost:${port}`);
});