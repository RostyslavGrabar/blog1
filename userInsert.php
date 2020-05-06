<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="style/style.css">
<?php
    require_once('header.php');
    
    require_once('configDB.php');
    require_once('passwordHasher.php');
?>
<div class='d-flex justify-content-center w-100 h-100'>
    <form action="" method="POST" class="m-5 userInsertForm  border border-info p-2 shadow rounded" enctype="multipart/form-data">
    <h5 class='text-secondary text-center mt-2 mb-3'> РЕЄСТРАЦІЯ КОРИСТУВАЧА</h5>
        <div class="form-group">
            <label for="formGroupExampleInput" class='text-info'>Логін</label>
            <input type="text" class="form-control border border-info " id="formGroupExampleInput" placeholder="" name ='Login'>
            <?php
            if ($_SERVER['REQUEST_METHOD'] =='POST'){
                $login = $_POST['Login'];
                if($login == ''){
?>
                <small class="text-danger">Введіть логін</small>
<?php
                }
            }
?>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1" class='text-info'>Електронна адреса</label>
            <input type="email" class="form-control border border-info " id="exampleInputEmail1" aria-describedby="emailHelp" name='Email'>
            <small id="emailHelp" class="form-text text-muted">Ми ніколи не поділимося вашим електронним адресом ні з ким іншим.</small>

<?php
            if ($_SERVER['REQUEST_METHOD'] =='POST'){
                $conn = mysqli_connect(servername, username, password, dbname);// підключення до бази даних(назва сервера, ім'я(root або root1), пароль(якщо є), ім'я бази в якій я хочу створити)
                if(!$conn){
                    die('Помилка при підключенні до БД ' . mysqli_connect_error()); // покаже помилку якщо не підключило
                }
                $email = $_POST['Email'];
                $sql = "SELECT * FROM `user` WHERE Email = '" . $email . "'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result)>0){  // перевіряє кількість ліній в запиті
?>
                    <small class="text-danger">Користувач з таким емaйл вже Існує</small>
<?php
                }
                if($email == ''){
?>
                    <small class="text-danger">Введіть електронну адресу</small>
<?php
                }
            }
?>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1" class='text-info'>Пароль</label>
            <input type="password" class="form-control border border-info" id="exampleInputPassword1" name = "Password">
            <?php
            if ($_SERVER['REQUEST_METHOD'] =='POST'){
                $password = $_POST['Password'];
                if($_POST['Password'] == ''){
?>
                    <small class="text-danger">Введіть пароль</small>
<?php
                }
            }
?>
        </div>

        <div class="form-group">
            <label for="exampleFormControlFile1" class='text-secondary'>Завантажте файл</label>
            <input type="file" class="form-control-file text-success " id="exampleFormControlFile1" name="Avatar">
        </div>
        <button type="submit" class='m-3 float-right text-success '>ЗБЕРЕГТИ</button>
    </form>
</div>
<?php

    if ($_SERVER['REQUEST_METHOD'] =='POST'){
        // var_dump($_FILES);
        $login = $_POST['Login'];
        $email = $_POST['Email'];
        $password = passwordHasher($_POST['Password']);

        if ($_POST['Login'] == '' && $_POST['Email'] == '' && $_POST['Password'] == ''){
            exit();

        }
        if (mysqli_num_rows($result)>0){  // перевіряє кількість ліній в запиті
            exit(); // не створить користувача
        }
        if ($_FILES['Avatar']['name'] != ''){ // перевірити чи загр фото
            $fileExtension = explode(".",$_FILES['Avatar']['name']);// стрічку розділяє на масиви по розділовому знаку
            $fileName = md5(microtime()) . ' . ' . $fileExtension[count($fileExtension)-1];
            if (!file_exists('Avatar')){
                mkdir('avatar'); // створитти папку
            }
            move_uploaded_file($_FILES['Avatar']['tmp_name'], 'avatar/'.$fileName);// завантажити на сервер  [tmp_name] - шлях до фото
        }   else {
            $fileName = 'noPhoto.png';
        }
        // $sql = "INSERT INTO user (Login, Password) VALUES ('"'Rostyslav' , '1111')";
        $sql = "INSERT INTO user (Login, Email, Password, urlAvatar) VALUES ('" . $login . "', '" . $email . "', '" . $password . "','" . $fileName . "')";
        if(mysqli_query($conn, $sql)){
            mysqli_close($conn);
            $checkUrl = 'http://localhost/blog1/email/check_email.php?id=' . $email;
            $message_email = 'Підтвердіть електонну адресу за';
            $message_email .= '<a href="' . $checkUrl . '">посиланням</a>';
            header('Location: email/Send_Email.php?Email='.$email.'&Text='.$message_email);

            
                    // сесія інформація доступна для клієнта і сервера
            // session_start(); // початок сесії(ми записуємо в сесію якісь значення)
            // $_SESSION['isAut'] = true; // записуємо значення true в сесію
            // $_SESSION['Login'] = $login;  // записуємо змінну в сесію
            // $_SESSION['urlAvatar'] = $fileName;
            // $_SESSION['Role'] = 'follower';
            // Header('Location: index.php'); // після виконання переходить на index.php
        
        } else {
            echo 'Error:' . $sql . ' ' . mysqli_error($conn);

        }
        // mysqli_close($conn);
}
?>


  <?php
    require_once('footer.php')
?>

