{{-- Modal show account --}}
<div class="modal-container" id="accountShow">
	<div class="modal">
		<div class="modal-header">
			<h3>Thông tin tài khoản</h3>
			<button onclick="closeModal(event, '#accountShow')"><span class="las la-times"></span></button>
		</div>
		<div class="modal-body">
			<div class="profile">
				<div class="left">
					<img src="./dist/img/avatar/avt-default.jfif" alt="avatar" width="100%">
					<h4>Nguyễn Trung Hậu</h4>
					<p>Phòng Bưu chính, Viễn thông - Công nghệ thông tin</p>
					<p>Trưởng phòng</p>
				</div>
				<div class="right">
					<div class="information">
						<h3>Thông tin chung</h3>
						<div class="information-data">
							<div class="data">
								<h4>Ngày sinh: </h4>
								<p id="txt-dob"></p>
							</div>
							<div class="data">
								<h4>Giới tính: </h4>
								<p id="txt-sex"></p>
							</div>
						</div>
						<div class="information-data">
							<div class="data">
								<h4>Email: </h4>
								<p id="txt-email"></p>
							</div>
							<div class="data">
								<h4>Điện thoại: </h4>
								<p id="txt-phone"></p>
							</div>
						</div>
						<div class="information-data">
							<div class="data">
								<h4>Địa chỉ: </h4>
								<p id="txt-address"></p>
							</div>
						</div>
					</div>
					<div class="information">
						<h3>Tài khoản</h3>
						<div class="information-data">
							<div class="data">
								<h4>Tài khoản: </h4>
								<p id="txt-account"></p>
							</div>
							<div class="data">
								<h4>Vai trò: </h4>
								<p id="txt-role"></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button class="btn btn-primary" onclick="closeModal(event, '#accountShow')">Đóng</button>
		</div>
	</div>
</div>


<div class="modal-container" id="accountAdd">
	<div class="modal modal-md">
		<form id="account-add" data-url="{{ route('account.store') }}">
			<div class="modal-header">
				<h3 class="text-primary">Thêm tài khoản</h3>
				<button onclick="closeModal(event,'#accountAdd')"><span class="las la-times"></span></button>
			</div>
			<div class="modal-body">
				<div class="form-container">
					<div class="form-control">
						<div class="input-box-50">
							<span class="input-label">Họ và tên:</span>
							<input type="text" name="name_add" placeholder="Nhập họ và tên">
							<span class="error-text error_name_add text-danger"></span>
						</div>
						<div class="radio-box-50">
							<span class="input-label">Giới tính:</span>
							<div class="radio-group" style="margin-top: 10px">
								<div class="radio-item-50">
									<input type="radio" name="gender_add" value="0" checked>
									<span>Nam</span>
								</div>
								<div class="radio-item-50">
									<input type="radio" name="gender_add" value="1"><span>Nữ</span>
								</div>
							</div>
							<span class="error-text error_gender_add text-danger"></span>
						</div>
						<div class="input-box-50">
							<span class="input-label">Ngày sinh:</span>
							<input type="text" name="date_add" placeholder="dd-mm-YY">
							<span class="error-text error_date_add text-danger"></span>
						</div>
						<div class="input-box-50">
							<span class="input-label">Điện thoại:</span>
							<input type="text" name="phone_add" placeholder="Nhập số điện thoại">
							<span class="error-text error_phone_add text-danger"></span>
						</div>
						<div class="input-box-100">
							<span class="input-label">Địa chỉ:</span>
							<input type="text" name="address_add" placeholder="Nhập địa chỉ">
							<span class="error-text error_address_add text-danger"></span>
						</div>
						<div class="select-box-50">
							<span class="input-label">Đơn vị:</span>
							<select id="department_add" name="department_add">
								<option>Chưa chọn đơn vị</option>
							</select>
							<span class="error-text error_department_add text-danger"></span>
						</div>
						<div class="select-box-50">
							<span class="input-label">Chức vụ:</span>
							<select id="position_add" name="position_add">
								<option>Chưa chọn vị trí</option>
							</select>
							<span class="error-text error_position_add text-danger"></span>
						</div>
						<div class="input-box-50">
							<span class="input-label">Email:</span>
							<input type="text" name="email_add" placeholder="Nhập tên email">
							<span class="error-text error_email_add text-danger"></span>
						</div>
						<div class="select-box-50">
							<span class="input-label">Loại tài khoản:</span>
							<select id="role_add" name="role_add">
								<option>Chưa chọn vai trò</option>
							</select>
							<span class="error-text error_role_add text-danger"></span>
						</div>
						<div class="input-box-50">
							<span class="input-label">Tài khoản:</span>
							<input type="text" name="username_add" placeholder="Nhập tên tài khoản">
							<span class="error-text error_username_add text-danger"></span>
						</div>
						<div class="input-box-50">
							<span class="input-label">Mật khẩu:</span>
							<input type="password" name="password_add" placeholder="Nhập mật khẩu">
							<span class="error-text error_password_add text-danger"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Tạo mới</button>
				<button class="btn btn-danger" onclick="closeModal(event,'#accountAdd')">Đóng</button>
			</div>
		</form>
	</div>
</div>


<div class="modal-container" id="accountEdit">
	<div class="modal modal-md">
		<form id="account-edit" method="POST">
			<div class="modal-header">
				<h3 class="text-success">Chỉnh sửa tài khoản</h3>
				<button onclick="closeModal(event,'#accountEdit')"><span class="las la-times"></span></button>
			</div>
			<div class="modal-body">
				<div class="form-container">
					<div class="form-control">
						@method('PATCH')
						<div class="input-box-50">
							<span class="input-label">Họ và tên:</span>
							<input type="text" name="name_edit" id="name_edit" placeholder="Nhập họ và tên">
							<span class="error-text error_name_edit text-danger"></span>
						</div>
						<div class="radio-box-50">
							<span class="input-label">Giới tính:</span>
							<div class="radio-group" style="margin-top: 10px">
								<div class="radio-item-50">
									<input type="radio" name="gender_edit" id="gender_0" value="0">
									<span>Nam</span>
								</div>
								<div class="radio-item-50">
									<input type="radio" name="gender_edit" id="gender_1" value="1"><span>Nữ</span>
								</div>
							</div>
							<span class="error-text error_gender_edit text-danger"></span>
						</div>
						<div class="input-box-50">
							<span class="input-label">Ngày sinh:</span>
							<input type="text" name="date_edit" id="date_edit" placeholder="dd-mm-YY">
							<span class="error-text error_date_edit text-danger"></span>
						</div>
						<div class="input-box-50">
							<span class="input-label">Điện thoại:</span>
							<input type="text" name="phone_edit" id="phone_edit" placeholder="Nhập số điện thoại">
							<span class="error-text error_phone_edit text-danger"></span>
						</div>
						<div class="input-box-100">
							<span class="input-label">Địa chỉ:</span>
							<input type="text" name="address_edit" id="address_edit" placeholder="Nhập địa chỉ">
							<span class="error-text error_address_edit text-danger"></span>
						</div>
						<div class="select-box-50">
							<span class="input-label">Đơn vị:</span>
							<select id="department_edit" name="department_edit">
								<option>Chưa chọn đơn vị</option>
							</select>
							<span class="error-text error_department_edit text-danger"></span>
						</div>
						<div class="select-box-50">
							<span class="input-label">Chức vụ:</span>
							<select id="position_edit" name="position_edit">
								<option>Chưa chọn vị trí</option>
							</select>
							<span class="error-text error_position_edit text-danger"></span>
						</div>
						<div class="input-box-50">
							<span class="input-label">Email:</span>
							<input type="text" name="email_edit" id="email_edit" placeholder="Nhập tên email">
							<span class="error-text error_email_edit text-danger"></span>
						</div>
						<div class="select-box-50">
							<span class="input-label">Loại tài khoản:</span>
							<select id="role_edit" name="role_edit">
								<option>Chưa chọn vai trò</option>
							</select>
							<span class="error-text error_role_edit text-danger"></span>
						</div>
						<div class="input-box-50">
							<span class="input-label">Tài khoản:</span>
							<input type="text" name="username_edit" id="username_edit" placeholder="Nhập tên tài khoản">
							<span class="error-text error_username_edit text-danger"></span>
						</div>
						<div class="input-box-50">
							<span class="input-label">Mật khẩu:</span>
							<input type="password" name="password_edit" disabled>
							<span class="error-text error_password_edit text-danger"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success">Cập nhật</button>
				<button class="btn btn-danger" onclick="closeModal(event,'#accountEdit')">Đóng</button>
			</div>
		</form>
	</div>
</div>

{{-- Model change password --}}
<div class="modal-container" id="passwordChange">
	<div class="modal">
		<form id="change-pass" data-url="">
			<div class="modal-header">
				<h3 class="text-success">Đổi mật khẩu</h3>
				<button onclick="closeModal(event,'#passwordChange')"><span class="las la-times"></span></button>
			</div>
			<div class="modal-body">
				<div class="form-container">
					<div class="form-control">
						@method('PATCH')
						<div class="input-box-100">
							<span class="input-label">Mật khẩu mới:</span>
							<input type="password" name="password" placeholder="Nhập mật khẩu mới">
							<span class="error-text error_password text-danger"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success">Cập nhật</button>
				<button class="btn btn-danger" onclick="closeModal(event,'#passwordChange')">Đóng</button>
			</div>
		</form>
	</div>
</div>

