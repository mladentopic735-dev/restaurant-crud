<?php
session_start();
include "../config/db.php";

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $res = $conn->query("SELECT * FROM users WHERE email='$email'");
    $user = $res->fetch_assoc();

    if($user && password_verify($password, $user['password'])){
        $_SESSION['user'] = $user['ime'];
        $_SESSION['user_id'] = $user['id'];
        header("Location: ../index.php");
        exit;
    } else {
        $error = "Pogrešan email ili lozinka!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<h2>Login</h2>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="post">
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Lozinka" required><br><br>
    <button type="submit" name="login">Login</button>
</form>
<p>Nemate račun? <a href="register.php">Register</a></p>
</body>
</html>
