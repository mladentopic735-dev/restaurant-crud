<?php
$conn = new mysqli("localhost", "root", "", "restaurant");
if ($conn->connect_error) {
die("Greška: " . $conn->connect_error);
}
?>