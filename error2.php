<?php
// Start the session: must be the first command
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Error</h1>
    <?php
    // get parameter err
    if (isset($_SESSION['err'])) {
        echo "<p>Error: " . $_SESSION['err'] . "</p>";
        // delete the session variable 'err'
        unset($_SESSION['err']);
    }
    ?>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
