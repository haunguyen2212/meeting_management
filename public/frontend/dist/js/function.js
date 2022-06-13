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