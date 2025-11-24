<?php
// Start the session: must be the first command
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        .red {
            color: red;
        }
    </style>
</head>
<body>
    <!-- Login Formular-->
     <h1>Login</h1>
     <?php
     //  Falls die Session Variable err  existiert, 
     //  wurde beim letzen Login ein Fehler festgestellt.
     //  Dieser soll nun angezeigt werden
        if (isset($_SESSION['err'])) {
            echo "<p class='red'>Login error: " . $_SESSION['err']."</p>";
            // Löschung der Session Variable err
            unset($_SESSION['err']);
        }
     ?>
     
     <form action="login2.php" method="post">
        <label for="usernameID">Username:</label>
        <input type="text" id="usernameID" name="username" required><br><br>
        <label for="passwordID">Password:</label>
        <input type="password" id="passwordID" name="password"><br><br>
        <input type="reset" value="Reset">
        <input type="submit" value="Login" name="login">
    <!-- Links zu den anderen Formular Aktionen
        <input type="submit" formaction="forgotPassword2.php" value="Forgot Password" name="forgotPassword">
        <input type="submit" formaction="register2.php" value="Register" name="register">
     -->
    </form> 
</body>
</html>