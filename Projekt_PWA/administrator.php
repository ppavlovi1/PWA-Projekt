
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
</header><br><br>




<?php

session_start();
if(isset($POST["prijava"]));
$dbc = mysqli_connect('localhost', 'root', '','pwa');

// Check connection
if (!$dbc) {
  die("Connection failed: " . mysqli_connect_error());
}


$prijavaImeKorisnika = $_POST['korisnik'];
$prijavaLozinkaKorisnika = $_POST['lozinka'];

$sql = "SELECT korisnicko_ime, lozinka, razina FROM korisniklozinka, razina FROM korisnik 
WHERE korisnicko_ime = ?";

$stmt = mysqli_stmt_init($dbc);
 if (mysqli_stmt_prepare($stmt, $sql)) { 
  mysqli_stmt_bind_param($stmt, 's', $prijavaImeKorisnika); 
  mysqli_stmt_execute($stmt); 
  mysqli_stmt_store_result($stmt);
 } 
 mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaKorisnika, $levelKorisnika); 
 mysqli_stmt_fetch($stmt);

 if (password_verify($_POST['lozinka'], $lozinkaKorisnika) && mysqli_stmt_num_rows($stmt) > 0){ 

    $uspjesnaPrijava = true;
  

  if($levelKorisnika == 1) { 
    $admin = true; 
  } 
  else { 
    $admin = false;
   } 

   $_SESSION['$username'] = $imeKorisnika;
   $_SESSION['$level'] = $levelKorisnika;
  } 
  else { 
    $uspjesnaPrijava = false; 
  } 

  if (($uspjesnaPrijava == true && $admin == true) || (isset($_SESSION['$username'])) && $_SESSION['$level'] == 1){
    $query = "SELECT * FROM vijesti"; 
    $result = mysqli_query($dbc, $query); 
    while($row = mysqli_fetch_array($result)){

      echo"
      <form method='post'>
<label>Brisanje podataka iz baze - upisite ID</label><br>
<input type='number' name='broj'/>
<br>
<label>UPDATE NASLOVA - upisite ID</label><br>
<input type='number' name='broj2'/>
<br>
<input type='text' name='novinaslov'/>
<br>
<input type='submit'>
</from>
      ";
    }}
    else if($uspjesnaPrijava == true && $admin == false){

      echo '<p>Bok ' . $imeKorisnika . '! Uspješno ste prijavljeni, ali niste administrator.</p>';

    }
    else if(isset($_SESSION['$username']) && $_SESSION['$level'] == 0){
      echo '<p>Bok ' . $_SESSION['$username'] . '! Uspješno ste prijavljeni, ali niste administrator.</p>';
    }
    else if($uspjesnaPrijava == false){
     
    }
  



$idBrisanje=$_POST["broj"];
$idUpdate=$_POST["broj2"];
$naslov=$_POST["novinaslov"];

$dbc = mysqli_connect('localhost', 'root', '','pwa');


if (!$dbc) {
  die("Connection failed: " . mysqli_connect_error());
}
else{

    $query="DELETE * FROM vijesti WHERE id=$idBrisanje";
    $sql="UPDATE vijesti SET naslov=$naslov WHERE id=$idUpdate";

}


?>
<br><br>


<footer>
    <p class="dolje">Copyright 2019 ppavlovi1@tvz.hr</p>
</footer>

</div>
</body>
</html>