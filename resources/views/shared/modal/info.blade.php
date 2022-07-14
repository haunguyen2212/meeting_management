{{-- Modal change paswword --}}
<div class="modal-container" id="changePass">
	<div class="modal">
		<form id="change-pass">
			<div class="modal-header">
				<h3 class="text-success">Đổi mật khẩu</h3>
				<button onclick="closeModal(event,'#changePass')"><span class="las la-times"></span></button>
			</div>
			<div class="modal-body">
				<div class="form-container">
					<div class="form-control">
						@method('PATCH')
						<div class="input-box-100">
							<span class="input-label">Mật khẩu cũ:</span>
							<input type="password" name="old_pass" id="old_pass" placeholder="Nhập mật khẩu hiện tại">
							<span class="error-text error_old_pass text-danger"></span>
						</div>
						<div class="input-box-100">
							<span class="input-label">Mật khẩu mới:</span>
							<input type="password" name="new_pass" id="new_pass" placeholder="Nhập mật khẩu mới">
							<span class="error-text error_new_pass text-danger"></span>
						</div>
						<div class="input-box-100">
							<span class="input-label">Nhập lại mật khẩu mới:</span>
							<input type="password" name="renew_pass" id="renew_pass" placeholder="Nhập lại mật khẩu mới">
							<span class="error-text error_renew_pass text-danger"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success btn-password">Thay đổi</button>
				<button class="btn btn-danger" onclick="closeModal(event,'#changePass')">Đóng</button>
			</div>
		</form>
	</div>
</div>

{{-- Modal edit info --}}
<div class="modal-container" id="editInfo">
	<div class="modal modal-md">
		<form id="info-edit" method="POST">
			<div class="modal-header">
				<h3 class="text-success">Chỉnh sửa tài khoản</h3>
				<button onclick="closeModal(event,'#editInfo')"><span class="las la-times"></span></button>
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
						<div class="input-box-100">
							<span class="input-label">Email:</span>
							<input type="text" name="email_edit" id="email_edit" placeholder="Nhập tên email">
							<span class="error-text error_email_edit text-danger"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success">Cập nhật</button>
				<button class="btn btn-danger" onclick="closeModal(event,'#editInfo')">Đóng</button>
			</div>
		</form>
	</div>
</div>

{{-- Modal change image --}}
<div class="modal-container" id="changeImg">
	<div class="modal">
		<form id="change-img">
			<div class="modal-header">
				<h3 class="text-success">Đổi ảnh đại diện</h3>
				<button onclick="closeModal(event,'#changeImg')"><span class="las la-times"></span></button>
			</div>
			<div class="modal-body">
				<div class="form-container">
					<div class="form-control">
						@method('PATCH')
						<div class="file-box-100">
							<span class="input-label">Hình ảnh:</span>
							<input type="file" accept="image/*" name="img" id="img" onchange="chooseFile(event, this,'edit-upload')"><br>		
							<img id="edit-upload" alt="img" width="150px"><br>
							<span class="error-text error_img text-danger"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success">Cập nhật</button>
				<button class="btn btn-danger" onclick="closeModal(event,'#changeImg')">Đóng</button>
			</div>
		</form>
	</div>
</div>