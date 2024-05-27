<!DOCTYPE html>
<html lang="en">
<head>
<title>Title</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
}

/* Style the header #2A75FF #135CAF*/
.header {
  background-color: #99989A;
  padding: 30px;
  text-align: center;
  font-size: 35px;
}

/* Create three unequal columns that floats next to each other */
.column {
  float: left;
  padding: 10px;
  height: 450px; 
}

/* Left and right column */
.column.side {
  width: 25%;
}

/* Middle column */
.column.middle {
  width: 50%;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Style the footer */
.footer {
  background-color: #f1f1f1;
  padding: 10px;
  text-align: center;
}

/* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
@media (max-width: 600px) {
  .column.side, .column.middle {
    width: 100%;
  }
}
</style>
</head>
<body>

<h2>Header1</h2>
<p>Text1</p>
<p>Text2</p>

<div class="header">
<h2>Header2</h2>
</div>

<div class="row">
  <div class="column side" style="background-color:#aaa;">Colom1</div>
  <div class="column middle" style="background-color:#bbb;">Colom2</div>
  <div class="column side" style="background-color:#ccc;">Colom3</div>
</div>

<div class="footer">
  <p>Footer</p>
</div>

</body>
</html>
