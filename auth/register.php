<?php
include "../config/db.php";


if (isset($_POST['register'])) {
$ime = $_POST['ime'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);


$conn->query("INSERT INTO users VALUES (NULL,'$ime','$email','$password')");
header("Location: login.php");
}
?>


<form method="post">
<input name="ime" placeholder="Ime" required>
<input name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Lozinka" required>
<button name="register">Register</button>
</form>