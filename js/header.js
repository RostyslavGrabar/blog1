$(function(){
    $("#userLogin").click(function(){
        $.post('userLogin.php',{  //AJAX метод пост на якій сторінці
            'Email': $('#Email').val(),  // дані з інпутів
            'Password':$('#Password').val()
        }, function(data, status){   // відповідь
            if(data == true){
                $('#container-nav').load('container_nav.php #nav');//AJAX метод  частина яка перезавантажується
                alert('Користувача авторизовано');
            } else {
                alert('Невірний логін або пароль');
            }
            $('#LoginModal').modal('hide');
        })    
    })
    $('#logOut').click(function(){
        $.get('logOut.php', function(){ //AJAX метод get
            var locationUrl = location.href; // повертається адреса стрічки на якій знаходиться
            locationUrl = locationUrl.split('/');
            if(locationUrl[location.length-1] != 'index.php'){
                locationUrl[location.length-1] = 'index.php';
                window.location.href = locationUrl.join('/'); //  ?
            }
            $('#container-nav').load('container_nav.php #nav');//AJAX метод  частина яка перезавантажується

        })
    })
})