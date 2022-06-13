var _token = $('meta[name="csrf-token"]').attr('content');

// Change password
$('.btn-password').click(function(e){
    e.preventDefault();
    $('.error-text').html('');
    var pass = $('#new_pass').val();
    var repass = $('#renew_pass').val();
    if(pass == repass){
        var url = $('.btn-change-pass').attr('data-url');
        $('#change-pass').attr('data-url', url);
        $('#change-pass').submit();

    }
    else{
        $('.error_renew_pass').html('Mật khẩu không trùng khớp');
    }
});

$('#change-pass').submit(function(e){
    e.preventDefault();
    var url = $(this).attr('data-url');
    var formData = new FormData($(this)[0]);
    formData.append('_token', _token);
    $.ajax({
        type: 'post',
        url: url,
        data: formData,
        dataType: 'JSON',
        processData: false,
        cache: false,
        contentType: false,
        beforeSend: function(){
            $('.error-text').html('');
        },
        success: function(response){
            if(response.status == 1){
                window.location.reload();
            }
            else{
                $.each(response.error, function(prefix, val){
                    $('span.error_'+prefix).html(val[0]);
                });
            }
        }
    })
});


// Edit user info
$('.btn-edit').click(function(e){
    e.preventDefault();
    var url = $(this).attr('data-url');
    var update = $(this).attr('data-update');
    $.ajax({
        type: 'get',
        url: url,
        data:{_token,_token},
        success: function(response){
            showFormEdit(response.data);
            $('#info-edit').attr('data-url', update);
        }
    });
});

$('#info-edit').submit(function(e){
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
            if(response.status == 1){
                window.location.reload();
            }
            else{
                $.each(response.error, function(prefix, val){
                    $('span.error_'+prefix).html(val[0]);
                });
            }
        }
    });
});

function showFormEdit(obj){
    $('#name_edit').val(obj.name);
    $('#gender_'+obj.sex).prop("checked", true);
    $('#date_edit').val(formatDate(obj.date_of_birth));
    $('#phone_edit').val(obj.phone);
    $('#address_edit').val(obj.address);
    $('#email_edit').val(obj.email);
}

