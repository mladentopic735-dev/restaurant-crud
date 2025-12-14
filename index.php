<?php session_start(); ?>
<h2>Dobrodošao <?php echo $_SESSION['user']; ?></h2>
<a href="stolovi/index.php">Stolovi</a> |
<a href="meni/index.php">Meni</a> |
<a href="rezervacije/index.php">Rezervacije</a> |
<a href="auth/logout.php">Logout</a>