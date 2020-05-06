<?php
    session_start();
    session_unset(); // обновити  дані
    session_destroy(); //знищити сесію 
    Header('Location: index.php');
?>