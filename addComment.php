<?php
    require_once('configDB.php');
    
    
    
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $conn = mysqli_connect(servername, username, password, dbname);// підключення до бази даних(назва сервера, ім'я(root або root1), пароль(якщо є), ім'я бази в якій я хочу створити)
        if(!$conn){
            die('Помилка при підключенні до БД ' . mysqli_connect_error()); // покаже помилку
        }
        $text = $_POST['Text'];
        $sql = "INSERT INTO comment (IdAutor, IdRecord, Text) VALUES ('" . $_POST['IdAutor'] . "', '" . $_POST['IdRecord'] . "', '" . $_POST['Text'] .  "')";
        mysqli_query($conn, $sql);
        mysqli_close($conn);

        echo $text;
    }

?>