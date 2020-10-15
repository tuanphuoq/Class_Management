$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
$('#btn-student-list').on('click', function() {
	url = document.URL + '/student-list';
	// dùng ajax để xóa lấy danh sách học viên
	$.ajax({
		url: url,
		type: 'get',
		// data: {
		// 	classID: classID,
		// 	creatorID : creatorID
		// },
	})
	.done(function(response) {
		let i = 1;
		// đổ dữ liệu ra bảng trong model danh sách học viên
		$(response).each(function() {
			let tr = '<tr><td>'+i+'</td><td>'+this.name+'</td><td><button class="out-class btn btn-danger" student-id="'+this.student_id+'" class-id="'+this.class_id+'">out class</button></td></tr>';
			i++;
			$('#student-list-body').append(tr);
		})
	})
})

// xóa học viên ra khỏi lớp học
$(document).on('click', '.out-class', function() {
	var obj = $(this);
	let studentID = $(this).attr('student-id')
	let classID = $(this).attr('class-id')
	// console.log(studentID + ':' + classID);
	url = document.URL + '/delete-student';
	$.ajax({
		url: url,
		type: 'POST',
		data: {
			classID: classID,
			studentID : studentID
		},
	})
	.done(function(response) {
		// gửi thành công lên server
		if(response.status) { //nếu server xóa học viên khỏi lớp thành công
			// xóa học viên trên giao diện modal
			let deleteObj = $(obj).parent().parent();
			deleteObj.remove();
			//thông báo thành công
			toastr.success(response.message);
		} else { //nếu server trả về kết quả thất bại
			//thông báo thất bại
			toastr.error(response.message);
		}
	})
	.fail(function() {
		//thông báo thất bại
		toastr.error(response.message);
	})
})

// sự kiện thêm học viên vào lớp học
$('#btn-add-student').on('click', function() {
	var email = $('input#student-email').val();
	var teacherID = $(this).attr('teacher-id');
	url = document.URL + '/add-student';
	$.ajax({
		url: url,
		type: 'POST',
		data: {
			email: email,
			teacherID : teacherID
		},
	})
	.done(function(response) {
		// gửi thành công lên server
		if(response.status) { //nếu server mời học viênthành công
			$('#add-student-modal').modal('toggle');
			//thông báo thành công
			toastr.success(response.message);
		} else { //nếu server trả về kết quả thất bại
			//thông báo thất bại
			toastr.error(response.message);
		}
	})
	.fail(function() {
		//thông báo thất bại
		toastr.error(response.message);
	})
})

// sự kiện đồng ý cho học viên join vào lớp
$('#accept-request').on('click', function() {
	var obj = $(this);
	var requestID = $(this).attr('request-id')
	url = document.URL + '/accept-request';
	$.ajax({
		url: url,
		type: 'GET',
		data: {
			requestID: requestID
		},
	})
	.done(function(response) {
		// gửi thành công lên server
		if(response.status) { //nếu server mời học viênthành công
			// xóa request cua học viên trên giao diện modal
			let deleteObj = $(obj).parent().parent();
			deleteObj.remove();
			//thông báo thành công
			toastr.success(response.message);
		} else { //nếu server trả về kết quả thất bại
			//thông báo thất bại
			toastr.error(response.message);
		}
	})
	.fail(function() {
		//thông báo thất bại
		toastr.error(response.message);
	})
})