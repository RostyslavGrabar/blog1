<?php
    require_once('header.php');
    require_once('configDB.php');
    require_once('passwordHasher.php');

?>

<h1>Налаштування</h1>
<form action="" method="POST" class='m-5' enctype="multipart/form-data">
    <div class="form-group">
        <label for="formGroupExampleInput">Новий Логін</label>
        <input type="text" class="form-control mb-5" id="formGroupExampleInput" name="Login">
    </div>

    <div class="form-group  mt-3">
        <h5>Змінити пароль</h5>
        <label for="exampleInputPassword1">Старий пароль</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="Password">
        <label for="exampleInputPassword2">Новий пароль</label>
        <input type="password" class="form-control mb-5" id="exampleInputPassword2" name="PasswordNew">
    </div>

    <div class="form-group">
        <label for="exampleFormControlFile1">Змінити аватарку</label>
        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="Avatar">
    </div>
    <button type="submit">ЗБЕРЕГТИ</button>
</form>

<?php if($_SERVER['REQUEST_METHOD']=='POST'){
    $conn = mysqli_connect(servername, username, password, dbname);
    if(!$conn) {
        die('Помилка при підключенні до БД ' . mysqli_connect_error());
    }
    $sql = "SELECT * FROM user WHERE Login ='" . $_SESSION['Login'] . "'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $Id = $row['Id'];
    $password = passwordHasher($_POST['Password']);
    $newPassword = passwordHasher($_POST['PasswordNew']);

    // change name


    if($_POST['Login']!=''){
        $sql = "UPDATE user SET Login ='" . $_POST['Login'] . "' WHERE Id = '" . $Id . "'";
        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
            $_SESSION['Login'] = $_POST['Login'];
        } else {
            echo 'Error: ' . $sql . ' ' . mysqli_error($conn);
        }
    }

    // change password

    if($password === $row['Password'] || $_POST['PasswordNew']!='' ){
        $sqlPassword = "UPDATE user SET Password ='" . $newPassword . "' WHERE Id = '" . $Id . "'";
        if (mysqli_query($conn, $sqlPassword)) {
            mysqli_close($conn);
        } else {
            echo 'Error: ' . $sqlPassword . ' ' . mysqli_error($conn);
        }
    } 

    // change avatar


    if ($_FILES['Avatar']['name'] != '') {
        $fileExtention = explode(".", $_FILES['Avatar']['name']);
        $fileName = md5(microtime()) . '.' . $fileExtention[count($fileExtention) - 1];
        move_uploaded_file($_FILES['Avatar']["tmp_name"], 'avatar/' . $fileName);
        $sqlAvatar = "UPDATE user SET urlAvatar ='" . $fileName  . "' WHERE Id = '" . $Id . "'";
        if (mysqli_query($conn, $sqlAvatar)) {
            $_SESSION['urlAvatar'] = $fileName;
            mysqli_close($conn);
        } else {
            echo 'Error: ' . $sqlAvatar . ' ' . mysqli_error($conn);
        }
    } 
}






require_once('footer.php');

?>