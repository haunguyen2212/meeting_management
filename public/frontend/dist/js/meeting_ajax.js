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
                console.log(response);
                showData(response.data);
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

function showData(obj){
    var str = '';
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

    str += '<div><strong>Tên cuộc họp: </strong>'+obj.info.meet_name+'</div>';
    str += '<div><strong>Phân loại: </strong>'+obj.type.name+'</div>';
    str += '<div><strong>Tên đơn vị: </strong>'+obj.department.name+'</div>';
    str += '<div><strong>Người đăng ký: </strong>'+obj.register.name+'</div>';
    str += '<div><strong>Phòng họp: </strong>'+((obj.room) ? obj.room.name : '')+'</div>';
    str += '<div><strong>Cán bộ hỗ trợ: </strong>'+((obj.supporter) ? obj.supporter.name : ' ')+'</div>';
    str += '<div><strong>Thời gian thử nghiệm: </strong>'+formatDateTime(obj.info.test_time)+'</div>'
    str += '<div><strong>Thời gian bắt đầu: </strong>'+formatDateTime(obj.info.start_time)+'</div>';
    str += '<div><strong>Thời gian kết thúc: </strong>'+formatDateTime(obj.info.end_time)+'</div>';
    str += '<div><strong>Trạng thái: </strong><span class="'+color+'">'+status+'</span></div>';
    str += '<div><strong>Ngày duyệt: </strong>'+((obj.info.approval_time) ? formatDateTime(obj.info.approval_time) : ' ')+'</div>';
    str += '<div><strong>Ghi chú: </strong>'+((obj.info.feedback) ? obj.info.feedback : ' ')+'</div>';

    $('#showInfo').html('');
    $('#showInfo').html(str);
}

