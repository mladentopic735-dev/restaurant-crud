<?php include "../config/db.php"; ?>


<form method="post">
<input name="naziv" placeholder="Naziv">
<input name="cijena" placeholder="Cijena">
<button name="add">Dodaj</button>
</form>


<?php
if (isset($_POST['add'])) {
$conn->query("INSERT INTO meni VALUES (NULL,'$_POST[naziv]','$_POST[cijena]')");
}


$res = $conn->query("SELECT * FROM meni");
while ($m = $res->fetch_assoc()) {
echo "$m[naziv] - $m[cijena] KM <br>";
}
?>