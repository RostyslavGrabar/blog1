<?php
    require_once('configDB.php');
    require_once('passwordHasher.php');




        if ($_SERVER['REQUEST_METHOD'] =='POST'){
            $email = $_POST['Email'];
            $password = passwordHasher($_POST['Password']);
            $conn = mysqli_connect(servername, username, password, dbname);// підключення до бази даних(назва сервера, ім'я(root або root1), пароль(якщо є), ім'я бази в якій я хочу створити)
            if(!$conn){
                die('Помилка при підключенні до БД ' . mysqli_connect_error()); // покаже помилку
            }
            $sql = "SELECT * FROM user WHERE Email = '" . $email . "' AND Password = '" . $password . "'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result)>0 && $_POST['Email'] != '' && $_POST['Password'] != ''){
                $row = mysqli_fetch_assoc($result);
                session_start();
                $_SESSION['isAut'] = true; // записуємо значення true в сесію
                $_SESSION['Login'] = $row['Login'];  // записуємо змінну в сесію
                $_SESSION['urlAvatar'] = $row['urlAvatar'];
                $_SESSION['Role'] = $row['Role'];
                echo true;
            }   else {
                echo false;
            }     
        }
?>

