<?php include "../config/db.php"; ?>


<form method="post">
<input name="broj" placeholder="Broj stola">
<input name="kapacitet" placeholder="Kapacitet">
<button name="add">Dodaj</button>
</form>


<?php
if (isset($_POST['add'])) {
$conn->query("INSERT INTO stolovi VALUES (NULL,'$_POST[broj]','$_POST[kapacitet]')");
}


$res = $conn->query("SELECT * FROM stolovi");
while ($r = $res->fetch_assoc()) {
echo "Sto $r[broj_stola] - $r[kapacitet] mjesta <br>";
}
?>