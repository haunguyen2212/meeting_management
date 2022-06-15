function showModal(e, id){
    e.preventDefault();
    $(id).addClass('show');
}

function closeModal(e, id){
    e.preventDefault();
    $(id).removeClass('show');
    return false;
}

function formatDate(date){
    var parts = date.split('-');
    var format = parts[2]+'-'+parts[1]+'-'+parts[0]; 
    return format;
}

function chooseFile(e, fileInput, id){
    e.preventDefault();
    if(fileInput.files && fileInput.files[0]){
        var reader = new FileReader();

        reader.onload = function(e){
            $('#'+id).attr('src', e.target.result);
            $('#'+id).show();
        }
        reader.readAsDataURL(fileInput.files[0]);
    }
}