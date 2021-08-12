<?php
session_start();

$servername = "lrgs.ftsm.ukm.my";
$username = "a174863";
$password = "tinyredfox";
$dbname = "a174863";
 
$conn = null;
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>