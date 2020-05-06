<?php
    require_once('header.php');
    require_once('configDB.php');
    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $conn = mysqli_connect(servername, username, password, dbname);// підключення до бази даних(назва сервера, ім'я(root або root1), пароль(якщо є), ім'я бази в якій я хочу створити)
        if(!$conn){
            die('Помилка при підключенні до БД ' . mysqli_connect_error()); // покаже помилку
        }
        $sql = "SELECT record.Id as Id, record.Date as `Date`, record.Text as `Text`, record.Like as `Like`,
                record.DisLike as `DisLike`, user.Login as autor
                FROM record
                LEFT JOIN `user`
                ON record.Id_author = user.Id
                WHERE record.Id = '" . $_GET['Id'] . "'";
      
        $result = mysqli_query($conn, $sql);
        $record = mysqli_fetch_assoc($result);
        $recordId = $record['Id'];
?>
        <div class="m-4 p-3  shadow">
            <span>Автор: <?=$record['autor']?></span>
            <br>
            <span>Дата: <?=$record['Date']?></span>
            <br>
            <p align=justify class="mt-3"><?=$record['Text']?></p>
            <div class="mb-2 ml-2">
                <p class="d-inline">
                    <img src="img/like.png" alt="" class="likeImg"> 
                    <span id="count<?=$record['Id']?>"><?= $record['Like']?></span>
                </p>
                <p style="display: inline">
                    <img src="img/dislake.png" alt="" style="width: 15px; height:auto">
                    <span id="countDisLike<?=$record['Id']?>"><?=$record['DisLike']?></span>
<?php
                    $sql_comm = "SELECT * FROM comment";
                    $result_comm = mysqli_query($conn, $sql_comm);
                    while ($record_comm = mysqli_fetch_assoc($result_comm)){
?>
                        <p class="addTextComment"><?=$record_comm['IdAutor']?></p>
<?php
                    }
?>

                </p>
            </div>
           <a href="#" type="button" class="w-100 btn btn-success" data-toggle="modal" data-target="#CommentModal">ДОДАТИ КОМЕНТАР</a>
        </div>

<?php
    }
?>

<!-- Modal -->
<div class="modal fade" id="CommentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ДОДАТИ КОМЕНТАР</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" style="visibility:hidden" id="IdRecord" value="<?=$recordId?>">
        <!-- визначити idAutor через бд  -->
        <input type="text" style="visibility:hidden" id="IdAutor" value="<?=$_SESSION['Login']?>">
        <div class="form-group">
            <textarea class="form-control border border-info" id="textComment" rows="10" name = "Text" ></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ЗАКРИТИ</button>
        <button type="button" class="btn btn-primary" id="saveComment">ЗБЕРЕГТИ</button>
      </div>
    </div>
  </div>
</div>

<?php
    require_once('footer.php');

?>
<script src="js/addComment.js"></script>