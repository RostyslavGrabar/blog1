<?php
    require_once('header.php');
    require_once('configDB.php');

    // echo 'http://' . $_SERVER['HTTP_HOST'];   виведе шлях до сервера

    $conn = mysqli_connect(servername, username, password, dbname);// підключення до бази даних(назва сервера, ім'я(root або root1), пароль(якщо є), ім'я бази в якій я хочу створити)
    if(!$conn){
        die('Помилка при підключенні до БД ' . mysqli_connect_error()); // покаже помилку
    }

    $sql ="SELECT * FROM record WHERE status = 'approved'";
    $result = mysqli_query($conn, $sql);
    while ($record = mysqli_fetch_assoc($result)){
            $sql_comment = "SELECT COUNT(IdRecord) as `CountComm` from `comment` WHERE IdRecord ='" . $record['Id'] . "'";
            $res_comm = mysqli_query($conn, $sql_comment);
            $res_comm = mysqli_fetch_assoc($res_comm);
        ?>
        <div class="m-4 p-3  shadow">
            <span class="text-secondary"> Дата: </span><span class="text-info"> <?= $record['Date']?></span>
            <br>
            <p align=justify class="mt-3"><?=$record['Text']?></p>
            <p align=right >Коментарів: <?=$res_comm['CountComm']?></p>
            <div class="mb-2 ml-2">
                <p class="d-inline" onclick="addLike(<?=$record['Id']?>)">
                    <img src="img/like.png" alt="" class="likeImg"> 
                    <span id="count<?=$record['Id']?>"><?= $record['Like']?></span>
                </p>
                <p style="display: inline" onclick="addDisLike(<?=$record['Id']?>)">
                    <img src="img/dislake.png" alt="" style="width: 15px; height:auto">
                    <span id="countDisLike<?=$record['Id']?>"><?=$record['DisLike']?></span>
                </p>
            </div>
           <a href="viewItemRecord.php?Id=<?=$record['Id']?>" type="button" class="w-100 btn btn-success">ПЕРЕГЛЯНУТИ</a>
        </div>
<?php
    }
?>




<?php
    require_once('footer.php')
?>

<script>
    function addLike(Id){
        $.post('addLike.php',{
            'Id' : Id
        }, function(data, status){
            if(data){
                var result = JSON.parse(data);
                $('#count'+result.Id).text(result.Like); // добавляє лайк
            }
        })
    }
    function addDisLike(Id){
        $.post('addDisLike.php', {
            'Id': Id
        }, function(data, status){
            if (data){
                var result = JSON.parse(data);
                $('#countDisLike'+result.Id).text(result.DisLike);
            }
        })
    }
</script>