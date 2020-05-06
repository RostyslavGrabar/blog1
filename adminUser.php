<?php
    require_once('header.php');
    require_once('configDB.php');

    $conn = mysqli_connect(servername, username, password, dbname);// підключення до бази даних(назва сервера, ім'я(root або root1), пароль(якщо є), ім'я бази в якій я хочу створити)
    if(!$conn){
        die('Помилка при підключенні до БД ' . mysqli_connect_error()); // покаже помилку
    }
    $sql = "SELECT * FROM user";
    $result = mysqli_query($conn, $sql);
?>

<table border="1" class="m-5">
    <thead>
        <td>ID</td>
        <td>Login</td>
        <td>Email</td>
        <td>Role</td>
        <td>Change Role</td>
        <td>Delete</td>
    </thead>
    <tbody>

<?php
    while ($record = mysqli_fetch_assoc($result)){
?>

       <tr>
            <td class="Id"> <?=$record['Id']?> </td>
            <td> <?=$record['Login']?> </td>
            <td> <?=$record['Email']?> </td>
            <td class="TextRole"> <?=$record['Role']?> </td>
            <td>
                <select name="Role" class="ChangeRole" >
                    <option value="follower">Читач</option>
                    <option value="autor">Автор</option>
                    <option value="administrator">Адміністратор</option>
                </select>
            </td>
            <td>
                DELETE
            </td>
       </tr>         


<?php
    }
?>

    </tbody>
</table>




<?php
    require_once('footer.php');

?>

<script src="js/userRole.js"></script>