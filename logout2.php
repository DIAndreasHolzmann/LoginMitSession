<?php
// Start the session: must be the first command
session_start();
// remove all session variables
session_unset();
// destroy the session
session_destroy(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Sie wurden abgemeldet</h1>
    <p><a href="formular2.php">Login</a></p>
</body>
</html>