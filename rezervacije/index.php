<?php
session_start();
include "../config/db.php";

// Ako korisnik nije logovan, preusmjeri na login
if(!isset($_SESSION['user'])){
    header("Location: ../auth/login.php");
    exit;
}

$error = '';
$success = '';

// Dodavanje rezervacije
if(isset($_POST['add'])){
    $ime_gosta = $_POST['ime'];
    $sto_id = $_POST['sto'];
    $datum = $_POST['datum'];
    $vrijeme = $_POST['vrijeme'];

    // Provjera da li je sto zauzet za izabrani datum i vrijeme
    $check = $conn->query("SELECT * FROM rezervacije WHERE sto_id = $sto_id AND datum='$datum' AND vrijeme='$vrijeme'");
    if($check->num_rows > 0){
        $error = "Odabrani sto je već rezervisan za taj datum i vrijeme!";
    } else {
        $conn->query("INSERT INTO rezervacije (ime_gosta, sto_id, datum, vrijeme) VALUES ('$ime_gosta','$sto_id','$datum','$vrijeme')");
        $success = "Rezervacija uspješno dodana!";
    }
}

// Dohvati sve stolove
$stolovi_res = $conn->query("SELECT * FROM stolovi");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Rezervacije</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<h2>Rezervacije - Dobrodošao <?php echo $_SESSION['user']; ?></h2>
<p><a href="../index.php">Početna</a> | <a href="../logout.php">Logout</a></p>

<?php if($error) echo "<p style='color:red;'>$error</p>"; ?>
<?php if($success) echo "<p style='color:green;'>$success</p>"; ?>

<form method="post">
    <input type="text" name="ime" placeholder="Ime gosta" required><br><br>
    <input type="date" name="datum" required><br><br>
    <input type="time" name="vrijeme" required><br><br>
    
    <select name="sto" required>
        <option value="">Odaberi sto</option>
        <?php while($sto = $stolovi_res->fetch_assoc()): ?>
            <option value="<?php echo $sto['id']; ?>">
                Sto <?php echo $sto['broj_stola']; ?> - <?php echo $sto['kapacitet']; ?> mjesta
            </option>
        <?php endwhile; ?>
    </select><br><br>
    
    <button type="submit" name="add">Rezerviši</button>
</form>

<h3>Lista rezervacija</h3>
<?php
$reservacije = $conn->query("SELECT r.id, r.ime_gosta, r.datum, r.vrijeme, s.broj_stola 
                             FROM rezervacije r 
                             JOIN stolovi s ON r.sto_id = s.id
                             ORDER BY r.datum, r.vrijeme");

while($r = $reservacije->fetch_assoc()){
    echo "Gost: ".$r['ime_gosta']." | Sto: ".$r['broj_stola']." | Datum: ".$r['datum']." | Vrijeme: ".$r['vrijeme']."<br>";
}
?>
</body>
</html>
