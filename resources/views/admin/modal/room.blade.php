{{-- Modal add room --}}
<div class="modal-container" id="roomAdd">
	<div class="modal">
		<form id="room-add" data-url="{{ route('room.store') }}">
			<div class="modal-header">
				<h3 class="text-primary">Thêm phòng họp</h3>
				<button onclick="closeModal(event,'#roomAdd')"><span class="las la-times"></span></button>
			</div>
			<div class="modal-body">
				<div class="form-container">
					<div class="form-control">
						<div class="input-box-100">
							<span class="input-label">Tên phòng:</span>
							<input type="text" name="name_add" placeholder="Nhập tên phòng">
							<span class="error-text error_name_add text-danger"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Tạo mới</button>
				<button class="btn btn-secondary" onclick="closeModal(event,'#roomAdd')">Đóng</button>
			</div>
		</form>
	</div>
</div>

{{-- Modal room edit --}}
<div class="modal-container" id="roomEdit">
	<div class="modal">
		<form id="room-edit">
			<div class="modal-header">
				<h3 class="text-success">Chỉnh sửa phòng họp</h3>
				<button onclick="closeModal(event,'#roomEdit')"><span class="las la-times"></span></button>
			</div>
			<div class="modal-body">
				<div class="form-container">
					<div class="form-control">
                        @method('PUT')
						<div class="input-box-100">
							<span class="input-label">Tên phòng:</span>
							<input type="text" name="name_edit" id="name_edit" placeholder="Nhập tên phòng">
							<span class="error-text error_name_edit text-danger"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success">Chỉnh sửa</button>
				<button class="btn btn-danger" onclick="closeModal(event,'#roomEdit')">Đóng</button>
			</div>
		</form>
	</div>
</div>