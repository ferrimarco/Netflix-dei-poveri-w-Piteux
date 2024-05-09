<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = "";

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $password = $_POST['password'];
    $email =  $_POST['email'];
    $emailCheckQuery = "SELECT * FROM users WHERE email='$email'";

    //echo $password;

    $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);
    //cho "Encrypted Password". $encryptedPassword;

    $mysqli = new mysqli("mysql","root","root","db_film");
    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }

    $result = $mysqli->query($emailCheckQuery);

    if ($result->num_rows > 0) {
        echo "<script>alert('L\'email inserita è già associata ad un account');</script>";
        exit;
    } else {

        $sql = "INSERT INTO users (name, last_name, email, password, registration_date) VALUES ('$name', '$surname', '$email', '$encryptedPassword', NOW())";

        if ($mysqli->query($sql) === TRUE) {
            echo "<script>alert('Registrazione avvenuta con successo');</script>";
            echo "<script> window.location.href = 'sign.html'; </script>";
            exit;
        } else {
            echo "Errore nella registrazione dell'utente: " . $mysqli->connect_error;
        }
    }
}


/*if (password_verify($password, $encryptedPassword)) {
            
}*/
?>