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

function formatDateTime(dateTime){
    var n = dateTime.trim().lastIndexOf(' ');
    var date = dateTime.substring(0, n).split('-');
    var time = dateTime.substring(n + 1, dateTime.length).split(':');
    var format = time[0]+':'+time[1]+' '+date[2]+'/'+date[1]+'/'+date[0];
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
