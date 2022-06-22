{{-- Modal show meeting --}}
<div class="modal-container" id="meetingShow">
	<div class="modal">
		<div class="modal-header">
			<h3 class="text-primary">Thông tin cuộc họp</h3>
			<button onclick="closeModal(event,'#meetingShow')"><span class="las la-times"></span></button>
		</div>
		<div class="modal-body">
			<div id="showInfo"></div>
		</div>
		<div class="modal-footer">
			<button class="btn btn-secondary" onclick="closeModal(event,'#meetingShow')">Đóng</button>
		</div>
	</div>
</div>