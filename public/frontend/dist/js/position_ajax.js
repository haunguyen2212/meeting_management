var _token = $('meta[name="csrf-token"]').attr('content');

// Add position
$('#position-add').submit(function(e){
    e.preventDefault();
    var url = $(this).attr('data-url');
    var formAdd = new FormData($(this)[0]);
    formAdd.append('_token', _token);
    $.ajax({
        type: 'post',
        url: url,
        data:formAdd,
        dataType: 'JSON',
        processData: false,
        cache: false,
        contentType: false,
        beforeSend: function(){
            $('.error-text').html('');
        },
        success: function(response){
            if(typeof response.error != 'undefined'){
                $.each(response.error, function(prefix, val){
                    $('span.error_'+prefix).html(val[0]);
                });
            }
            else{
                window.location.reload();
            }
        },
        error: function(error){
            toastr["error"]("Có lỗi xảy ra, thử lại sau", "Thất bại");
            setTimeout(function(){window.location.reload();}, 1500);
        }
    });
});

//Edit position
$('.btn-edit').click(function(e){
    e.preventDefault();
    var url = $(this).attr('data-url');
    var update = $(this).attr('data-update');
    $.ajax({
        type: 'get',
        url: url,
        data:{_token:_token},
        success: function(response){
            if(response.status == 1){
                $('#name_edit').val(response.data.name);
                $('#position-edit').attr('data-url', update);
            }
            else{
                window.location.reload();
            }
        },
        error: function(error){
            toastr["error"]("Có lỗi xảy ra, thử lại sau", "Thất bại");
            setTimeout(function(){window.location.reload();}, 1500);
        }
    });
});

$('#position-edit').submit(function(e){
    e.preventDefault();
    var url = $(this).attr('data-url');
    var formEdit = new FormData($(this)[0]);
    formEdit.append('_token', _token);
    $.ajax({
        type: 'post',
        url: url,
        data: formEdit,
        dataType: 'JSON',
        processData: false,
        cache: false,
        contentType: false,
        beforeSend: function(){
            $('.error-text').html('');
        },
        success: function(response){
            if(typeof response.error != 'undefined'){
                $.each(response.error, function(prefix, val){
                    $('span.error_'+prefix).html(val[0]);
                });
            }
            else{
                window.location.reload();
            } 
        },
        error: function(error){
            toastr["error"]("Có lỗi xảy ra, thử lại sau", "Thất bại");
            setTimeout(function(){window.location.reload();}, 1500);
        }
    })
});

//Delete room
$('.btn-delete').click(function(e){
    e.preventDefault();
    if(confirm('Bạn có chắc muốn xóa không?')){
        var url = $(this).attr('data-url');
        $.ajax({
            type: 'delete',
            url: url,
            data: {_token:_token},
            success: function(response){ 
                window.location.reload();          
            },
            error: function(error){
                toastr["error"]("Có lỗi xảy ra, thử lại sau", "Thất bại");
                setTimeout(function(){window.location.reload();}, 1500);
            }
        });
    }
});