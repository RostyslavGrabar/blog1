<?php
    require_once('configDB.php');

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $conn = mysqli_connect(servername, username, password, dbname);// підключення до бази даних(назва сервера, ім'я(root або root1), пароль(якщо є), ім'я бази в якій я хочу створити)
        if(!$conn){
            die('Помилка при підключенні до БД ' . mysqli_connect_error()); // покаже помилку
        }
        $sql = "UPDATE record SET `Like` = `Like` + 1 WHERE Id  = ' " . $_POST['Id'] ."'";
        if(mysqli_query($conn, $sql)){
            $sql ="SELECT * FROM record WHERE Id  = ' " . $_POST['Id'] ."'";
            $result = mysqli_query($conn, $sql);
            $record = mysqli_fetch_assoc($result);            
            mysqli_close($conn);
            echo json_encode($record);
        } else {
            echo false;
        }
    }