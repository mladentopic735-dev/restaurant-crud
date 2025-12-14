<?php
session_start();
include "../config/db.php";


if (isset($_POST['login'])) {
$email = $_POST['email'];
$password = $_POST['password'];


$res = $conn->query("SELECT * FROM users WHERE email='$email'");
$user = $res->fetch_assoc();


if ($user && password_verify($password, $user['password'])) {
$_SESSION['user'] = $user['ime'];
header("Location: ../index.php");
}
}
?>


<form method="post">
<input name="email" placeholder="Email">
<input type="password" name="password" placeholder="Lozinka">
<button name="login">Login</button>
</form>