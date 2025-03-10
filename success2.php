<?php
// Start the session: must be the first command
session_start();
// Umleitung zum Login-Formular, wenn der User nicht angemeldet ist
if (!isset($_SESSION['username'])) {
    $_SESSION['err']="Login required";
    header("Location: formular2.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Sie sind angemeldet</h1>
    <?php
        echo "<p>Herzlich Willkommen: " . $_SESSION['username']."</p>";
    ?>
    <p><a href="logout2.php">Logout</a></p>
</body>
</html>