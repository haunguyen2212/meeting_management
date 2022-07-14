{{-- Modal approval --}}
<div class="modal-container" id="sendFeedback">
	<div class="modal">
		<form id="send-feedback" >
			<div class="modal-header">
				<h3 class="text-primary">Phản hồi đăng ký</h3>
				<button onclick="closeModal(event,'#sendFeedback')"><span class="las la-times"></span></button>
			</div>
			<div class="modal-body">
				<div class="form-container">
					<div class="form-control">
						<div class="input-box-100">
							<span class="input-label">Nhập phản hồi:</span>
							<input type="text" name="feedback" id="feedback" placeholder="Nhập phản hồi">
							<span class="error-text error_feedback text-danger"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Phản hồi</button>
				<button class="btn btn-secondary" onclick="closeModal(event,'#sendFeedback')">Đóng</button>
			</div>
		</form>
	</div>
</div>