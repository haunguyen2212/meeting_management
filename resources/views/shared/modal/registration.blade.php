{{-- Modal show department --}}
<div class="modal-container" id="registrationShow">
	<div class="modal">
		<div class="modal-header">
			<h3 class="text-success">Thông tin đăng ký</h3>
			<button onclick="closeModal(event,'#registrationShow')"><span class="las la-times"></span></button>
		</div>
		<div class="modal-body">
			<div id="showDetail"></div>
		</div>
		<div class="modal-footer">
			<button class="btn btn-secondary" onclick="closeModal(event,'#registrationShow')">Đóng</button>
		</div>
	</div>
</div>
