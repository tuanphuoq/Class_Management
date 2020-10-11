$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

var userID;
$('.btn-change').on('click', function() {
	userID = $(this).attr('data-id');
})

$('#save-user').on('click', function() {
	let role = $('#state').val();
	$.ajax({
		url: '/user/role',
		type : 'POST',
		data: {
			role: role,
			user: userID
		},
	})
	.done(function(response) {
		if(response.status) {
			$('#modal-id').modal('toggle');
			toastr.success(response.message);
		} else {
			toastr.error(response.message);
		}
	})
	.fail(function() {
		toastr.error(response.message);
	})
})