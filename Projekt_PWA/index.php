<!DOCTYPE html>
<html>
<head>
<title>Pocetna</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header class="boja"> 
    
    <nav class="nav">
        <img src="slika0.png" class="slikaHead"/>
        <a href="index.php">HOME</a> |
        <a href="clanak.php">CLANAK</a> |
        <a href="unos.html">UNOS</a> |
        <a href="Sport.php">SPORT</a>
        <a href="CrnaKronika.php">CRNA KRONIKA</a>
        <a href="administrator.php">ADMINISTRATOR</a>
        <a href="registracija.php">REGISTRACIJA</a>
        <a href="prijava.html">PRIJAVA</a>
      </nav>
</header>



<content>
<?php


if (isset($_POST["checkbox"])) {
    $arhiva=0;
  }
  else{
    $arhiva=1;
  }



$dbc = mysqli_connect('localhost', 'root', '','pwa');

// Check connection
if (!$dbc) {
  die("Connection failed: " . mysqli_connect_error());
}
else{
$query = "SELECT * FROM vijesti";
$result = $dbc->query($query);
$k=0;
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    if($row["Arhiva"]==1 and $row["Kategorija"]=="sport"){

        if($k==0){
            echo"SPORT";
            echo"<br><br><br>";
            $k=1;
        }
        
        $slika=$row["Slika"];
        echo "<link rel='stylesheet' type='text/css' href='style.css' />";
        echo "<div class='div1'>";
        echo"<h1>".$row["SadrzajKratki"]."</h1>";
        echo"<h2>".$row["Naslov"]."</h2>";
        echo"<img src='img/$slika'>";
        echo "<p>".$row["Sadrzaj"]."</p>";
        echo"</div>";
        
    }

  }
} 

echo"<br><br><br><br><br><br><br><br><br><br><br><br>";

if (!$dbc) {
    die("Connection failed: " . mysqli_connect_error());
  }
  else{
  $query2 = "SELECT * FROM vijesti";
  $result2 = $dbc->query($query2);
  $z=0;
  if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
      if($row["Arhiva"]==1 and $row["Kategorija"]=="crna kronika"){
  
          if($z==0){
              echo"CRNA KRONIKA";
              echo"<br><br><br>";
              $z=1;
          }
          
          $slika=$row["Slika"];
          echo "<link rel='stylesheet' type='text/css' href='style.css' />";
          echo"<div class='glavni'>";
          echo"<h2>".$row["Naslov"]."</h2>";
          echo "<div class='div1'>";
          echo"<img src='img/$slika'>";
          echo "<p>".$row["Sadrzaj"]."</p>";
          echo"</div>";
          echo"<br>";
      }
  
    }
  } 



}}


mysqli_close($dbc);


?>
</content>
<br>
<footer>
    <p class="dolje">Copyright 2019 ppavlovi1@tvz.hr</p>
</footer>


</body>
</html>