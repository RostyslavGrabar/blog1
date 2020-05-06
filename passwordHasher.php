<?php

    // // якщо добаваити salt  не можливо розкодувати
    const salt = 'Первинне визначення. Реалізовано у JavaScript 1.8.5';
    
    function passwordHasher($password){
        return sha1(salt . $password . salt);
    }

    // 2
    
    
    // function passwoordHasher($password){
    //     return sha1($password);
    // }





?>