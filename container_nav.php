<?php
    session_start();

?>  

<!-- частина яка перезавантажується -->
<nav class="navbar navbar-expand-lg navbar-light bg-light" id="nav">
    <a class="navbar-brand" href="index.php">Blog</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Запис <span class="sr-only">(current)</span></a>
        </li>

        <?php
          if(isset($_SESSION['Role']) && $_SESSION['Role'] == 'autor'){
        ?>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Мої записи
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="viewAutorAllRecord.php">Мої записи</a>
            <a class="dropdown-item" href="addRecord.php">Додати запис</a>
          </div>
        </li>

        <?php
          }
        ?>

        <?php
          if(isset($_SESSION['Role']) && $_SESSION['Role'] == 'administrator'){
        ?>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Панель адміністратора
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Записи</a>
            <a class="dropdown-item" href="#">Коментарі</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="adminUser.php">Користувачі</a>
        </div>
        </li>

        <?php
          }
        ?>

      </ul>


  <?php
      if(isset($_SESSION['isAut'])){
  ?>

          <img src="avatar/<?=$_SESSION['urlAvatar']?>" alt="" class="avatar mr-2">
          <a href="#"><?=$_SESSION['Login']?></a>
          <span class='mr-1 ml-1 text-secondary'>/</span>
          <a href="logOut.php" class="text-danger">Вихід</a>
  <?php
      } else {
  ?>
          <a href="userInsert.php">Реєстрація</a>
          <span class='mr-1 ml-1 text-secondary'>/</span>
          <a class="text-success" data-toggle="modal" data-target="#LoginModal">Авторизуватися</a>
  <?php
      }
  ?>

    </div>

  </nav>