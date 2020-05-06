$(function(){
    var elemId = $(".Id");
    var textRole =  $(".TextRole");
    var changeRole = $(".ChangeRole");
    var lengthElem = elemId.length;
    for(let i=0; i<lengthElem; i++){
        attachment(elemId[i], textRole[i], changeRole[i]);
    }
});

function attachment(elemId, textRole, changeRole){
    $(changeRole).change(function(){
        $.post('changeUserRole.php',{
            'Id':$(elemId).text(),
            'Role':$(changeRole).val()
        }, function(data, status){
            $(textRole).text(data)
        })
    })
}