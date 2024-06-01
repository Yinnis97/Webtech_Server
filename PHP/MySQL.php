<?php
$servername = "localhost";
$username = "yinnis";
$password = "serveryin126";
$dbname = "data";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}



$sql = "INSERT INTO data (name, age)
VALUES ('k','36')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully\n";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql = "SELECT name, age FROM data";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      echo " - name: " . $row["name"]. " - age: " . $row["age"]. "<br>";
  }
} else {
  echo "0 results";
}


$conn->close();
?>