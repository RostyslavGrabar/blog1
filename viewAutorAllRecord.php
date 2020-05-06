<?php
    require_once('header.php');
    require_once('configDB.php');

    $conn = mysqli_connect(servername, username, password, dbname);// підключення до бази даних(назва сервера, ім'я(root або root1), пароль(якщо є), ім'я бази в якій я хочу створити)
    if(!$conn){
        die('Помилка при підключенні до БД ' . mysqli_connect_error()); // покаже помилку
    }
    $sql = "SELECT * FROM user WHERE Login = '" . $_SESSION['Login'] . "'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $IdAuthor = $row['Id'];

    $sql ="SELECT * FROM record WHERE Id_author = '". $IdAuthor . "'";
    $result = mysqli_query($conn, $sql);
    while ($record = mysqli_fetch_assoc($result)){
        switch ($record['Status']) {
            case 'approved':
                $status = 'Підтверджено адміністратором';
            break;
            case 'not approved':
                $status = 'Не підтверджено адміністратором';
            break;
            case 'delete':
                $status = 'Видалено адміністратором';
            break;

        }
        ?>
        <div class="m-4 p-3  shadow">
            <span class="text-secondary"> Дата: </span><span class="text-info"> <?= $record['Date']?></span>
            <br>
            <span class="text-secondary"> Статус: </span><span class="text-danger">  <?=$status?> </span>
            <br>
            <p align=justify class="mt-3"><?=$record['Text']?></p>
            <div class="mb-2 ml-2">
                <p class="d-inline">
                    <img src="img/like.png" alt="" class="likeImg"> 
                    <?= $record['Like']?>
                </p>
                <p class="d-inline">
                    <img src="img/dislake.png" alt="" class="likeImg"> 
                    <?= $record['DisLike']?>
                </p>
            </div>
            <a href="updateRecord.php?id_record=<?= $record['Id']?>" type="button" class="btn btn-success">РЕДАГУВАТИ</a>
        </div>
<?php
    }
?>




<?php
    require_once('footer.php');
?>



<!-- ?id_record=  передасть id на іншу сторінку GET запит -->