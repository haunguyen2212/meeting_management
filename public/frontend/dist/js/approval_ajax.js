var _token = $('meta[name="csrf-token"]').attr('content');

// Accept meeting
$('.btn-accept').click(function(e){
    e.preventDefault();
    var url = $(this).attr('data-url');
    var _method = 'patch';
    if(confirm('Cho phép diễn ra cuộc họp này?')){
        $.ajax({
            type: 'post',
            url: url,
            data:{
                _token:_token,
                _method:_method,
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

//Deny meeting
$('.btn-deny').click(function(e){
    e.preventDefault();
    var url = $(this).attr('data-url');
    $('#send-feedback').attr('data-url', url);
});

$('#send-feedback').submit(function(e){
    e.preventDefault();
    var url = $(this).attr('data-url');
    var _method = 'patch';
    var feedback = $('#feedback').val();
        $.ajax({
            type: 'post',
            url: url,
            data:{
                _token:_token,
                _method:_method,
                feedback:feedback,
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