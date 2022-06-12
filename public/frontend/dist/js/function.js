function showModal(e, id){
    e.preventDefault();
    $(id).addClass('show');
}

function closeModal(e, id){
    e.preventDefault();
    $(id).removeClass('show');
    return false;
}