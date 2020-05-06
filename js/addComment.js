$(function(){
    var IdRecord = $("#IdRecord");
    var IdAutor = $("#IdAutor");
    var textComment = $("#textComment");
    var addTextComment = $('.addTextComment')

    $('#saveComment').click(function(){
        $.post('addComment.php',{
            'IdRecord':$(IdRecord).val(),
            'IdAutor':$(IdAutor).val(),
            'Text':$(textComment).val()
        }, function(data, status){
            $(addTextComment).text(data)
            $('#CommentModal').modal('hide');
        }) 
    })

    
})