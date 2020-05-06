<?php
    require_once('header.php');
    require_once('configDB.php');

    if ($_SERVER['REQUEST_METHOD']=='GET'){
        $conn = mysqli_connect(servername, username, password, dbname);// підключення до бази даних(назва сервера, ім'я(root або root1), пароль(якщо є), ім'я бази в якій я хочу створити)
        if(!$conn){
            die('Помилка при підключенні до БД ' . mysqli_connect_error()); // покаже помилку
        }
        $sql = "SELECT * FROM record WHERE Id = '" . $_GET['id_record'] . "'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
?>
    <div class="m-4 p-5 border border-info shadow">
        <h2 class = "text-info mb-5"> РЕДАГУВАТИ ЗАПИС</h2>
        <form action="" method = "POST">
            <div class="form-group">
                <label for="Id"> <span class="text-success">ID</span>  оголошення:</label>
                <input class="text-success mb-4" type="text" name="Id" readonly value=<?=$row['Id']?>>
                <textarea class="form-control border border-dark" id="exampleFormControlTextarea1" rows="10" name = "Text"><?=$row['Text']?></textarea>
            </div>
            <button  type = "submit" class="text-success mt-3">ЗБЕРЕГТИ</button>
        </form>
    </div>
<?php
    }
?>
<?php 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $conn = mysqli_connect(servername, username, password, dbname);// підключення до бази даних(назва сервера, ім'я(root або root1), пароль(якщо є), ім'я бази в якій я хочу створити)
        if(!$conn){
            die('Помилка при підключенні до БД ' . mysqli_connect_error()); // покаже помилку
        }
        $sql = "UPDATE record SET Text = '" . $_POST['Text'] . " ', Status = 'not approved' WHERE Id  = ' " . $_POST['Id'] ."'";
        if(mysqli_query($conn, $sql)){
            mysqli_close($conn);
            Header('Location: viewAutorAllRecord.php'); // після виконання переходить на index.php
        } else {
            echo 'Error:' . $sql . ' ' . mysqli_error($conn);
        }
    }


    require_once('footer.php');
?>

