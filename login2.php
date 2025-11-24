<?php
// Start the session: must be the first command
session_start();
?>

<?php
    if (!isset($_REQUEST['username']) || !isset($_REQUEST['password'])) {
        // $_SESSION: enthält die Session-Variablen:
        // Diese existieren  für die Dauer der Session: 
        // Bis die Session beendet wird oder der Browser geschlossen wird. 
        $_SESSION['err']="Login: Username or password is empty";
        // Umleitung auf das Formular
        header("Location: formular2.php");
        exit();
    }
    // Auslesen der Formulardaten aus dem Request-Objekt
    $user = $_REQUEST['username'];
    $pass = $_REQUEST['password'];
    
    if (empty($user) || empty($pass)) {
        // $_SESSION: enthält die Session-Variablen:
        // Diese existieren  für die Dauer der Session: 
        // Bis die Session beendet wird oder der Browser geschlossen wird.
        // In die Session Variable err wird die Fehlermeldung gespeichert
        $_SESSION['err']="Login: Username or password is empty";
        // Umleitung auf das Formular
        header("Location: formular2.php");
        exit();
    }

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        // Fehler bei der Verbindung zur Datenbank in die Session Variable err speichern
        $_SESSION['err']=$conn->connect_error;
        // Umleitung auf die Fehlerseite
        header("Location: error2.php");
        exit(); 
    }

    // SQL to create table "users"
    // create table users ( username varchar(100) not null primary key, passwort varchar(100) not null);

    $sql="SELECT username, passwort FROM users WHERE username = ? AND passwort = ?";
    // Prepare and bind the statement with parameters
    $stmt = $conn->prepare($sql);
    // Es werden die Parameter (?) an die vorbereitete Anweisung gebunden
    // "ss" bedeutet, dass zwei String-Parameter gebunden werden
    // $user und $pass sind die Variablen, die die Werte enthalten
    $stmt->bind_param("ss", $user, $pass);
    // Execute the statement
    $stmt->execute();
    // Check for errors during execution
    if ($stmt->error) {
        // Fehler Meldung in die Session Variable err speichern
        $_SESSION['err']= $stmt->error;
        // Umleitung auf die Fehlerseite
        header("Location: error2.php");
        // close the connection to the db
        $conn->close();
        // Beenden des Skripts
        exit(); 
    }  

    // Get the result set from the prepared statement
    $result = $stmt->get_result();
    // Check if any rows were returned
    if ($result->num_rows > 0) {
        // Save the username in the session
        $_SESSION['username']=$user;
        // Redirect to success page
        header("Location: success2.php");
    } else {
        // Login failed, set error message in session
        $_SESSION['err']="Login failed";
        // Redirect back to the login form
        header("Location: formular2.php");
    }
    
    // close the connection
    $stmt->close();
    $conn->close();

?>
