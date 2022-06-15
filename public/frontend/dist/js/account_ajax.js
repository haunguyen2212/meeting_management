var _token = $('meta[name="csrf-token"]').attr('content');


// Show user info
$('.btn-show').click(function(e){
    e.preventDefault();
    var url = $(this).attr('data-url');
    $.ajax({
        type: 'get',
        url: url,
        data:{_token:_token},
        success: function(response){
            if(response.status == 1)
                showDataUser(response.data);
        }
    })
});

function showDataUser(obj){
    $('#accountShow .left img').attr('src', './dist/img/avatar/'+ obj.avatar);
    $('#accountShow .left h4').html(obj.name);
    $('#accountShow .left p').html(obj.department_name);
    $('#accountShow .left p:last-child').html(obj.position_name);
    $('#accountShow #txt-dob').html(formatDate(obj.date_of_birth));
    $('#accountShow #txt-sex').html((obj.sex == 0 )? 'Nam' : 'Nữ');
    $('#accountShow #txt-email').html(obj.email);
    $('#accountShow #txt-phone').html(obj.phone);
    $('#accountShow #txt-address').html(obj.address);
    $('#accountShow #txt-account').html(obj.username);
    $('#accountShow #txt-role').html(obj.role_name);
}

// Add new user
$('.btn-add').click(function(e){
    e.preventDefault();
    var url = $(this).attr('data-url');
    $.ajax({
        type: 'get',
        url: url,
        data:{_token:_token},
        success: function(response){
            showFormAdd(response.data);
        }
    })
});

$('form#account-add').submit(function(e){
    e.preventDefault();
    var url = $(this).attr('data-url');
    var formAdd = new FormData($(this)[0]);
    formAdd.append('_token', _token);
    $.ajax({
        type: 'post',
        url: url,
        data: formAdd,
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
        }
    });
});

function showFormAdd(obj){
    var strDepartment = '';
    var strPosition = '';
    var strRole = '';

    $.each(obj.departments, function(prefix, val){
        strDepartment += '<option value="'+val.id+'">'+val.name+'</option>';
    });
    $.each(obj.positions, function(prefix, val){
        strPosition += '<option value="'+val.id+'">'+val.name+'</option>';
    });
    $.each(obj.roles, function(prefix, val){
        strRole += '<option value="'+val.id+'">'+val.name+'</option>';
    });

    $('.error-text').html('');
    $('#department_add').html(strDepartment);
    $('#position_add').html(strPosition);
    $('#role_add').html(strRole);
}

//Edit user
$('.btn-edit').click(function(e){
    e.preventDefault();
    var url = $(this).attr('data-url');
    var update = $(this).attr('data-update');
    $.ajax({
        type: 'get',
        url: url,
        data:{_token:_token},
        success: function(response){
            showFormEdit(response.data);
            $('#account-edit').attr('data-url', update);
        }
    });
});

$('form#account-edit').submit(function(e){
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
        }
    });
});


function showFormEdit(obj){
    var strDepartment = '';
    var strPosition = '';
    var strRole = '';

    $.each(obj.departments, function(prefix, val){
        strDepartment += '<option value="'+val.id+'">'+val.name+'</option>';
    });
    $.each(obj.positions, function(prefix, val){
        strPosition += '<option value="'+val.id+'">'+val.name+'</option>';
    });
    $.each(obj.roles, function(prefix, val){
        strRole += '<option value="'+val.id+'">'+val.name+'</option>';
    });

    $('.error-text').html('');
    $('#department_edit').html(strDepartment);
    $('#position_edit').html(strPosition);
    $('#role_edit').html(strRole);

    $('#name_edit').val(obj.user.name);
    $('#gender_'+obj.user.sex).prop("checked", true);
    $('#date_edit').val(formatDate(obj.user.date_of_birth));
    $('#phone_edit').val(obj.user.phone);
    $('#address_edit').val(obj.user.address);
    $('#email_edit').val(obj.user.email);
    $('#username_edit').val(obj.user.username);
    $('#department_edit option[value='+obj.user.department_id+']').attr('selected','selected');
    $('#position_edit option[value='+obj.user.position_id+']').attr('selected','selected');
    $('#role_edit option[value='+obj.user.role_id+']').attr('selected','selected');
}

//Delete user
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
            }
        });
    }
});

//Change password
$('.btn-change-pass').click(function(e){
    e.preventDefault();
    var url = $(this).attr('data-url');
    $('#change-pass').attr('data-url', url);
})

$('#change-pass').submit(function(e){
    e.preventDefault();
    var url = $(this).attr('data-url');
    var formPass = new FormData($(this)[0]);
    formPass.append('_token', _token);
    $.ajax({
        type: 'post',
        url: url,
        data: formPass,
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
        }
    });
});