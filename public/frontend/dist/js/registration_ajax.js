var _token = $('meta[name="csrf-token"]').attr('content');

$('.btn-show').click(function(e){
    e.preventDefault();
    var url = $(this).attr('data-url');
    $.ajax({
        type: 'get',
        url: url,
        data:{_token:_token},
        success: function(response){
            if(response.status == 1){
                showDetail(response.data);
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

function showDetail(obj){
    var status = '';
    var color = '';
    if(obj.info.status == -1){
        status = 'Bị từ chối';
        color = 'text-danger';
    }
    else if(obj.info.status == 0){
        status = 'Chờ duyệt';
        color = 'text-secondary';
    }
    else{
        status = 'Đã duyệt';
        color = 'text-primary';
    }
    var str = '<h3 class="text-primary">THÔNG TIN CHUNG</h3>';
    str += '<div><strong>Tên cuộc họp: </strong>'+obj.info.meet_name+'</div>';
    str += '<div><strong>Đơn vị: </strong>'+obj.department.name+'</div>';
    str += '<div><strong>Loại đăng ký: </strong>'+obj.type.name+'</div>';
    if(obj.room){
        str += '<div><strong>Phòng họp: </strong>'+obj.room.name+'</div>';
    }
    str += '<div><strong>Thời gian thử nghiệm: </strong>'+formatDateTime(obj.info.test_time)+'</div>';
    str += '<div><strong>Thời gian bắt đầu: </strong>'+formatDateTime(obj.info.start_time)+'</div>';
    str += '<div><strong>Thời gian kết thúc: </strong>'+formatDateTime(obj.info.end_time)+'</div>';
    str += '<div><strong>Trạng thái: </strong> <strong class="'+color+'">'+status+'</strong></div>';
    str += '<div><strong>Phản hồi: </strong>'+((obj.info.feedback) ? obj.info.feedback : 'chưa có')+'</div>';
    if(obj.info.document){
        str += '<div><strong>Văn bản: </strong> <a class="text-primary" target="_blank" href="./dist/upload/'+obj.info.document+'">Xem văn bản</a></div>';
    }
    if(obj.supporter){
        str += '<hr><h3 class="text-primary">CÁN BỘ HỖ TRỢ</h3>'
        str += '<div><strong>Họ tên: </strong>'+obj.supporter.name+'</div>';
        str += '<div><strong>Số điện thoại: </strong>'+obj.supporter.phone+'</div>';
        str += '<div><strong>Email: </strong>'+obj.supporter.email+'</div>';
    }
    
    $('#showDetail').html('');
    $('#showDetail').html(str);
}

// Cancel registration
$('.btn-cancel').click(function(e){
    e.preventDefault();
    var url = $(this).attr('data-url');
    if(confirm('Bạn có chắc muốn hủy đăng ký không?')){
        $.ajax({
            type: 'delete',
            url: url,
            data:{_token:_token},
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