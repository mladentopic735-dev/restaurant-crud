<?php include "../config/db.php"; ?>


<form method="post">
<input name="ime" placeholder="Ime gosta">
<select name="sto">
<?php
$res = $conn->query("SELECT * FROM stolovi");
while ($s = $res->fetch_assoc()) {
echo "<option value='$s[id]'>Sto $s[broj_stola]</option>";
}
?>
</select>
<input type="date" name="datum">
<input type="time" name="vrijeme">
<button name="add">Rezerviši</button>
</form>


<?php
if (isset($_POST['add'])) {
$conn->query("INSERT INTO rezervacije VALUES (NULL,'$_POST[ime]','$_POST[sto]','$_POST[datum]','$_POST[vrijeme]')");
}


$res = $conn->query("SELECT * FROM rezervacije");
while ($r = $res->fetch_assoc()) {
echo "$r[ime_gosta] - $r[datum] $r[vrijeme]<br>";
}
?>