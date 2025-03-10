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
        header("Location: formular2.php");
        exit();
    }
    $user = $_REQUEST['username'];
    $pass = $_REQUEST['password'];
    
    if (empty($user) || empty($pass)) {
        $_SESSION['err']="Login: Username or password is empty";
        header("Location: formular2.php");
        exit();
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        $_SESSION['err']=$conn->connect_error;
        header("Location: error2.php");
        exit(); 
    }

    $sql="SELECT username, password FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    if ($stmt->error) {
        $_SESSION['err']= $stmt->error;
        header("Location: error2.php");
        $conn->close();
        exit(); 
    }  

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Save the username in the session
        $_SESSION['username']=$username;
        header("Location: success2.php");
    } else {
        $_SESSION['err']="Login failed";
        header("Location: formular2.php");
    }
    
    // close the connection
    $stmt->close();
    $conn->close();

?>
