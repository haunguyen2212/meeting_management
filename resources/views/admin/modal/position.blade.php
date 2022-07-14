{{-- Modal add position --}}
<div class="modal-container" id="positionAdd">
	<div class="modal">
		<form id="position-add" data-url="{{ route('position.store') }}">
			<div class="modal-header">
				<h3 class="text-primary">Thêm chức vụ</h3>
				<button onclick="closeModal(event,'#positionAdd')"><span class="las la-times"></span></button>
			</div>
			<div class="modal-body">
				<div class="form-container">
					<div class="form-control">
						<div class="input-box-100">
							<span class="input-label">Tên chức vụ:</span>
							<input type="text" name="name_add" placeholder="Nhập tên chức vụ">
							<span class="error-text error_name_add text-danger"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Tạo mới</button>
				<button class="btn btn-secondary" onclick="closeModal(event,'#positionAdd')">Đóng</button>
			</div>
		</form>
	</div>
</div>

{{-- Modal position edit --}}
<div class="modal-container" id="positionEdit">
	<div class="modal">
		<form id="position-edit">
			<div class="modal-header">
				<h3 class="text-success">Chỉnh sửa chức vụ</h3>
				<button onclick="closeModal(event,'#positionEdit')"><span class="las la-times"></span></button>
			</div>
			<div class="modal-body">
				<div class="form-container">
					<div class="form-control">
                        @method('PUT')
						<div class="input-box-100">
							<span class="input-label">Tên chức vụ:</span>
							<input type="text" name="name_edit" id="name_edit" placeholder="Nhập tên chức vụ">
							<span class="error-text error_name_edit text-danger"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success">Chỉnh sửa</button>
				<button class="btn btn-danger" onclick="closeModal(event,'#positionEdit')">Đóng</button>
			</div>
		</form>
	</div>
</div>