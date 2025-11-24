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
    
        // PHP-Code: Auslesen der Benutzer aus der Datenbank
       // Verbindung zur Datenbank herstellen
        //               Servername, Benutzername, Passwort, Datenbankname
        $connection = new mysqli("localhost", "root", "", "test");
        // Überprüfe ob die Verbindung zur Datenbank erfolgreich war
        if ($connection->connect_error) {
            // . ist der Concat Operator in PHP,  wie das + in JAVA
            die("Verbindung zur Datenbank fehlgeschlagen: " . $connection->connect_error);
        }

        // SQL-Query: prepare() bereitet das Statement vor. vorsicht wegen SQL-INJECTION
        //             ? sind Platzhalter für die 
        $sql="SELECT * FROM users ";
        $stmt = $connection->prepare($sql);
        // bind_param() bindet die Parameter an die Platzhalter entfällt hier
        // Datentypen: s = string, i = integer, d = double, b = blob
        // execute() führt das Statement aus
        $stmt->execute();
        // get_result() holt das Ergebnis des Statements
        $result = $stmt->get_result();
        // Überprüfe ob das Ergebnis leer ist
        if ($result->num_rows > 0) {
            // fetch_assoc() holt die Zeile aus dem Ergebnis
            // diese wird der Variablen $row zugewiesen
            // ist das Ergebnis leer, wird NULL zurückgegeben => false in PHP
            echo "<table>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["password"] . "</<td>";
                echo "</tr>";
            }
            echo "</table>";
            // Schließe das Statement und die Datenbankverbindung
            $stmt->close();
            $connection->close();
        } else {
            echo "Keine Benutzer gefunden!";
        }
    
    ?>



    <p><a href="logout2.php">Logout</a></p>
</body>
</html>