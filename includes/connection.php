<?php
$server = "doshalley.com";
$username = "doshalley_main";
$password = "1997doshalley";
$db = "doshalley_main";

// Create connection
$conn = mysqli_connect($server, $username, $password, $db);

mysqli_set_charset($conn, "utf8");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
?>