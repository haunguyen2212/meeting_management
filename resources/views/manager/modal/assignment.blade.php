{{-- Modal assigmnet --}}
<div class="modal-container" id="assignmentStaff">
	<div class="modal">
		<form id="assignment-staff" >
			<div class="modal-header">
				<h3 class="text-primary">Phân công cán bộ</h3>
				<button onclick="closeModal(event,'#assignmentStaff')"><span class="las la-times"></span></button>
			</div>
			<div class="modal-body">
				<div class="form-container">
					<div class="form-control">
						<div class="select-box-100">
							<span class="input-label">Chọn cán bộ:</span>
							<select id="supporter" name="supporter">
								<option>Chưa chọn cán bộ</option>
							</select>
							<span class="error-text error_supporter text-danger"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Cập nhật</button>
				<button class="btn btn-secondary" onclick="closeModal(event,'#assignmentStaff')">Đóng</button>
			</div>
		</form>
	</div>
</div>

{{-- Modal assigmnet --}}
<div class="modal-container" id="addSupporter">
	<div class="modal">
		<form id="add-supporter" data-url="{{ route('supporter.store') }}">
			<div class="modal-header">
				<h3 class="text-primary">Thêm cán bộ hỗ trợ</h3>
				<button onclick="closeModal(event,'#addSupporter')"><span class="las la-times"></span></button>
			</div>
			<div class="modal-body">
				<div class="form-container">
					<div class="form-control">
						<div class="select-box-100">
							<span class="input-label">Chọn cán bộ:</span>
							<select id="user" name="user">
								<option>Chưa chọn cán bộ</option>
							</select>
							<span class="error-text error_user text-danger"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Thêm</button>
				<button class="btn btn-secondary" onclick="closeModal(event,'#addSupporter')">Đóng</button>
			</div>
		</form>
	</div>
</div>