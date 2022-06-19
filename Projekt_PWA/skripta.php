
<!DOCTYPE html>
<html>
<head>
<title>Pocetna</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="boja">
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

<?php
$naslov=$_POST["text"];
$kratkis=$_POST["textarea1"];
$sadrzaj=$_POST["textarea2"];
$slika=$_POST["slika"];
$kategorija=$_POST["odabir"];


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
$query = "INSERT INTO vijesti (Naslov,SadrzajKratki,Sadrzaj,Slika,Kategorija,Arhiva)
VALUES ('$naslov','$kratkis','$sadrzaj','$slika','$kategorija','$arhiva')";
}

if (mysqli_query($dbc, $query)) {
  
  } else {
    echo "Error: " . $dbc . "<br>" . mysqli_error($query);
  }
  

  
echo "<link rel='stylesheet' type='text/css' href='style.css' />";
echo "<div class='naslov'>";
echo"<h1>".$kategorija."</h1>";
echo"<h2".$naslov."</h2>";
echo"<h3>".$kratkis."</hr>";
echo"<img src='img/$slika'/>";
echo"<br>";
echo"<p>".$sadrzaj."</p>";
echo "</div>";

mysqli_close($dbc);

?>



<footer>
    <p class="dolje">Copyright 2019 ppavlovi1@tvz.hr</p>
</footer>

</div>
</body>
</html>