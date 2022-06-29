var _token = $('meta[name="csrf-token"]').attr('content');

$('.btn-assignment').click(function(e){
    e.preventDefault();
    var url = $(this).attr('data-url');
    var update = $(this).attr('data-assignment');
    $.ajax({
        type: 'get',
        url: url,
        data:{_token:_token},
        success: function(response){
            if(response.status == 1){
                showSelectBoxSupporters(response.data);
                $('#assignment-staff').attr('data-url', update);
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

$('#assignment-staff').submit(function(e){
    e.preventDefault();
    var url = $(this).attr('data-url');
    var _method = 'patch';
    var supporter = $("#supporter").find(":selected").val();
    $.ajax({
        type: 'post',
        url: url,
        data:{
            _token:_token,
            _method:_method,
            supporter: supporter,
        },
        success: function(response){
            console.log(response);
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
})

function showSelectBoxSupporters(obj){
    var str = '<option>Chưa chọn cán bộ</option>';
    $.each(obj.supporters, function(prefix, val){
        str += '<option value="'+val.id+'">'+val.name+'</option>';
    });
    $('#supporter').html(str);
    if(obj.assignment){
        $('#supporter option[value='+obj.assignment+']').attr('selected','selected');
    }
    
}

// Hide supporter
$('.btn-hide').click(function(e){
    e.preventDefault();
    var url = $(this).attr('data-url');
    var _method = 'patch';
    if(confirm('Bạn có chắc muốn xóa không?')){
        $.ajax({
            type: 'post',
            url: url,
            data:{
                _token:_token,
                _method: _method,
            },
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

// Add supporter
$('.btn-add').click(function(e){
    e.preventDefault();
    var url = $(this).attr('data-url');
    $.ajax({
        type: 'get',
        url: url,
        data:{_token:_token},
        success: function(response){
            showSelectBoxUsers(response.data);
        },
        error: function(error){
            toastr["error"]("Có lỗi xảy ra, thử lại sau", "Thất bại");
            setTimeout(function(){window.location.reload();}, 1500);
        }
    });
});

$('#add-supporter').submit(function(e){
    e.preventDefault();
    var url = $(this).attr('data-url');
    var user = $("#user").find(":selected").val();
    $.ajax({
        type: 'post',
        url: url,
        data:{
            _token:_token,
            user: user,
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

        }
    });
});

function showSelectBoxUsers(obj){
    var str = '<option>Chưa chọn cán bộ</option>';
    $.each(obj, function(prefix, val){
        str += '<option value="'+val.id+'">'+val.name+'</option>';
    });
    $('#user').html(str);
}