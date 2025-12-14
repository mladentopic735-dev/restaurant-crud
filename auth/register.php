<?php
include "../config/db.php";

if(isset($_POST['register'])){
    $ime = $_POST['ime'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    if($check->num_rows > 0){
        $error = "Email je već registrovan!";
    } else {
        $conn->query("INSERT INTO users (ime, email, password) VALUES ('$ime','$email','$password')");
        header("Location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Register</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<h2>Register</h2>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="post">
    <input type="text" name="ime" placeholder="Ime" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Lozinka" required><br><br>
    <button type="submit" name="register">Register</button>
</form>
<p>Već imate račun? <a href="login.php">Login</a></p>
</body>
</html>
