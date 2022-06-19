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

<form>
<label>Upisite ime</label>
<br>
<input type="text" name="ime" id="ime"/>
<br>
<label>Upisite prezime</label>
<br>
<input type="text" name="prezime" id="prezime"/>
<br>
<label>Upisite username</label>
<br>
<input type="text" name="korisnik" id="korisnik"/>
<br>
<label>Upisite lozinku</label>
<br>
<input type="password" name="lozinka" id="lozinka"/>
<br>
<label>Ponovite lozinku</label>
<br>
<input type="password" name="lozinka2" id="lozinka2"/>
<br><br>
<input type="submit" id="salji" value="Register"/>
</form>

<?php
$dbc = mysqli_connect('localhost', 'root', '','pwa');

// Check connection
if (!$dbc) {
  die("Connection failed: " . mysqli_connect_error());
}
else{

$ime=$_POST["ime"];
$prezime=$_POST["prezime"];
$username=$_POST["korisnik"];
$lozinka=$_POST["lozinka"];

$hash_lozinka=password_hash($lozinka,CRYPT_BLOWFISH);
$razina=0;
$registriranKorisnik ='';

$query = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ?"; 
$stmt = mysqli_stmt_init($dbc); 
if (mysqli_stmt_prepare($stmt, $query)) { 

    mysqli_stmt_bind_param($stmt, 's', $username); 
    mysqli_stmt_execute($stmt); 
    mysqli_stmt_store_result($stmt); 
} 
if(mysqli_stmt_num_rows($stmt) > 0)
{ 
    $msg='Korisničko ime već postoji!';
 }
 else{

    $query="INSERT INTO korisnik (Ime,Prezime,korisnicko_ime,lozinka,razina)
    VALUES (?,?,?,?,?)";
    $stmt=mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $query)){
        mysqli_stmt_bind_param($stmt,'ssssd', $ime, $prezime, $username, $hash_lozinka, $razina);
        mysqli_stmt_execute($stmt); 
        $registriranKorisnik = true;
    }

    
 }
 mysqli_close($dbc);
 if($registriranKorisnik == true) { 
    echo '<p>Korisnik je uspješno registriran!</p>';
}else{
    echo '<p>Nije!</p>';
}
}



?>


<footer>
    <p class="dolje">Copyright 2019 ppavlovi1@tvz.hr</p>
</footer>

</div>
</body>
</html>