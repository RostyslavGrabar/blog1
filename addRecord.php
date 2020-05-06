<?php
    require_once('header.php');
    require_once('configDB.php');
    // session_start();


?>
<div class="m-4 p-5  shadow">
    <h2 class = " text-info mb-5"> ДОДАТИ ЗАПИС</h2>
    <form action="" method = "POST">
        <div class="form-group">
            <textarea class="form-control border border-info" id="exampleFormControlTextarea1" rows="10" name = "Text" ></textarea>
        </div>
        <button  type = "submit" class="text-success mt-3">ЗБЕРЕГТИ</button>
    </form>
</div>
<?php   
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $conn = mysqli_connect(servername, username, password, dbname);// підключення до бази даних(назва сервера, ім'я(root або root1), пароль(якщо є), ім'я бази в якій я хочу створити)
        if(!$conn){
            die('Помилка при підключенні до БД ' . mysqli_connect_error()); // покаже помилку
        }
        $sql = "SELECT * FROM user WHERE Login = '" . $_SESSION['Login'] . "'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);// перевести в масив
        $IdAuthor = $row['id'];
        $Text = htmlspecialchars($_POST['Text']);
        $Date = date('yy-m-d');
    

        $sql = "INSERT INTO record (Id_author, Text, Date) VALUES ('" . $IdAuthor . "', '" . $Text . "', '" . $Date . "')";
        if(mysqli_query($conn, $sql)){
            mysqli_close($conn);
            Header('Location: index.php'); // після виконання переходить на index.php
        } else {
            echo 'Error:' . $sql . ' ' . mysqli_error($conn);
            echo $fileName;
        }
    }
?>





<?php
    require_once('footer.php')
?>