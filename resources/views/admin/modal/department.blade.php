{{-- Modal show department --}}
<div class="modal-container" id="departmentShow">
	<div class="modal">
		<div class="modal-header">
			<h3 class="text-primary">Thông tin đơn vị</h3>
			<button onclick="closeModal(event,'#departmentShow')"><span class="las la-times"></span></button>
		</div>
		<div class="modal-body">
			<div id="name_department">
                <strong>Tên đơn vị: </strong><span></span>
            </div>
            <div id="num_member">
                <strong>Thành viên: </strong><span></span>
            </div>
            <div id="list-member">
                <strong>Danh sách thành viên:</strong><br>
                <span></span>
            </div>
		</div>
		<div class="modal-footer">
			<button class="btn btn-secondary" onclick="closeModal(event,'#departmentShow')">Đóng</button>
		</div>
	</div>
</div>

{{-- Modal add department --}}
<div class="modal-container" id="departmentAdd">
	<div class="modal">
		<form id="department-add" data-url="{{ route('department.store') }}">
			<div class="modal-header">
				<h3 class="text-primary">Thêm đơn vị</h3>
				<button onclick="closeModal(event,'#departmentAdd')"><span class="las la-times"></span></button>
			</div>
			<div class="modal-body">
				<div class="form-container">
					<div class="form-control">
						<div class="input-box-100">
							<span class="input-label">Tên đơn vị:</span>
							<input type="text" name="name_add" placeholder="Nhập tên đơn vị">
							<span class="error-text error_name_add text-danger"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Tạo mới</button>
				<button class="btn btn-secondary" onclick="closeModal(event,'#departmentAdd')">Đóng</button>
			</div>
		</form>
	</div>
</div>

{{-- Modal room edit --}}
<div class="modal-container" id="departmentEdit">
	<div class="modal">
		<form id="department-edit">
			<div class="modal-header">
				<h3 class="text-success">Chỉnh sửa đơn vị</h3>
				<button onclick="closeModal(event,'#departmentEdit')"><span class="las la-times"></span></button>
			</div>
			<div class="modal-body">
				<div class="form-container">
					<div class="form-control">
                        @method('PUT')
						<div class="input-box-100">
							<span class="input-label">Tên đơn vị:</span>
							<input type="text" name="name_edit" id="name_edit" placeholder="Nhập tên đơn vị">
							<span class="error-text error_name_edit text-danger"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success">Chỉnh sửa</button>
				<button class="btn btn-danger" onclick="closeModal(event,'#departmentEdit')">Đóng</button>
			</div>
		</form>
	</div>
</div>