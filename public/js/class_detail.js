$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

$(document).on('click', '#btn-student-list', function() {
	url = document.URL + '/student-list';
	role = $(this).attr('role')
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
			if (role == 1 || role == 2) {
				let tr = '<tr><td>'+i+'</td><td>'+this.name+'</td><td>'+this.email+'</td><td><button class="out-class btn btn-danger" student-id="'+this.student_id+'" class-id="'+this.class_id+'">out class</button></td></tr>';
				i++;
				$('#student-list-body').append(tr);
			} else {
				let tr = '<tr><td>'+i+'</td><td>'+this.name+'</td><td>'+this.email+'</td></tr>';
				i++;
				$('#student-list-body').append(tr);
			}
			
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
$('.accept-request').on('click', function() {
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

// Document section
$('.edit-document').on('click', function() {
	$('#upload-document-modal input[name="description"]').val($(this).attr('description'))
	$('#upload-document-modal input[name="document_id"]').val($(this).attr('document-id'))
	$('#upload-document-modal input[name="classFile"]').prop('required', false)
	let temp = $('#upload-document-modal form').attr('action')
	let action = temp + 'edit-document'
	$('#upload-document-modal form').attr('action', action)
})
$('#add-document').on('click', function() {
	// add new document
	$('#upload-document-modal input[name="description"]').val()
	let temp = $('#upload-document-modal form').attr('action')
	let action = temp + 'upload'
	$('#upload-document-modal form').attr('action', action)
})
$('.delete-document').on('click', function() {
	var obj = $(this)
	Swal.fire({
	  title: 'Do you want to delete the document?',
	  showCancelButton: true,
	  confirmButtonText: `Delete`,
	}).then((result) => {
	  /* Read more about isConfirmed, isDenied below */
	  if (result.isConfirmed) {
	  	var documentID = $(this).attr('document-id');
		url = document.URL + '/delete-document';
	  	$.ajax({
			url: url,
			type: 'GET',
			data: {
				documentID: documentID
			},
		})
		.done(function(response) {
			// gửi thành công lên server
			if(response.status) { //nếu server mời học viênthành công
				// xóa document trên giao diện
				let deleteObj = $(obj).parent().parent();
				deleteObj.remove();
				//thông báo thành công
				Swal.fire('Deleted!', '', 'success')
			}
		})
	  }
	})
});

//add comment

// add new parent comment
$(document).on('keypress', '.comment-form #comment-content', function (e) {
	// when press ENTER
	var content = $('.comment-form #comment-content').val().trim()
	if(e.keyCode  == 13 && content != ""){
		let commentor = $('.comment-form .commentor').attr('commentor')
		let username = $('.comment-form .commentor').html()
		let url = document.URL + '/add-comment';
        $.ajax({
			url: url,
			type: 'POST',
			data: {
				commentor: commentor,
				content : content
			},
		})
		.done(function(response) {
			// gửi thành công lên server
			if(response.status) { //nếu server mời học viênthành công
				// xóa document trên giao diện
				let html = '<div class="comment-item row">'+
			            '<div class="col-lg-2 col-xs-4 avatar-comment">'+
			                '<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7c/User_font_awesome.svg/512px-User_font_awesome.svg.png" alt="">'+
			                '<div class="commentor font-weight-bold">'+
			                	username+
			            	'</div></div>' +
			            '<div class="col-lg-10 col-xs-8 content-comment">' +
			                '<textarea type="text" name="" id="" >' + content + '</textarea>'+
			                '<div class="action"><span>now </span>'+
			                    '<span class="text-warning edit-comment px-1" comment-id="'+ response.id +'">Edit</span>'+
			                    '<span class="text-danger delete-comment px-1" comment-id="'+ response.id +'">Delete</span>'+
			                    '</div></div></div>'
			    $('hr#hr').before(html)
			    $('.comment-form #comment-content').val("")
				//thông báo thành công
				console.log(response.message);
			}
		})
    }
});

// add-edit new child comment
$(document).on('keypress', '#reply-comment-content', function (e) {
	let content = $(this).val().trim()
	let parentCommentID = $(this).attr('parent-comment-id')
	if(e.keyCode  == 13 && content != ""){
		let obj = $(this)
		let subComment = $(this).attr('sub-comment-id')
		if (subComment == null) {
			//add sub comment
			let url = document.URL + '/add-sub-comment';
			$.ajax({
				url: url,
				type: 'POST',
				data: {
					parent_id : parentCommentID,
					content : content
				},
			})
			.done(function(response) {
				// gửi thành công lên server
				if(response.status) { //nếu server add sub comment thành công
					// update value sub comment
					$(obj).val(content)
					$(obj).prop("readonly" , "true")
					$(obj).attr("sub-comment-id" , response.id)
					let html = '<div class="action"><span>now </span>'+
				                '<span class="text-warning edit-comment px-1" comment-id="'+ parentCommentID +'" sub-comment-id="'+ response.id +'">Edit</span>'+
				                '<span class="text-danger delete-comment px-1" comment-id="'+ parentCommentID +'" sub-comment-id="'+ response.id +'">Delete</span>'+
				                '</div></div></div>'
				    $(obj).after(html)
					//thông báo thành công
					console.log(response.message);
				} else {
					toastr.error(response.message);
				}
			})
		} else {
			//edit sub comment
			let url = document.URL + '/edit-sub-comment';
			$.ajax({
				url: url,
				type: 'POST',
				data: {
					parent_id : parentCommentID,
					sub_comment_id : subComment,
					content : content
				},
			})
			.done(function(response) {
				// gửi thành công lên server
				if(response.status) { //nếu server edit sub comment thành công
					// update value sub comment
					$(obj).val(content)
					$(obj).prop("readonly" , "true")
					//thông báo thành công
					console.log(response.message);
				} else {
					toastr.error(response.message);
				}
			})
		}
	}
});

//edit comment
$(document).on('keypress', '.content-comment .edit-commented', function (e) {
	let obj = $(this)
	let content = $(this).val().trim()
	// edit parent comment
	if(e.keyCode  == 13 && content != ""){
		var commentID = $(this).attr('comment-id');

		//edit comment
		let url = document.URL + '/edit-comment'
		//send to server
		$.ajax({
			url: url,
			type: 'POST',
			data: {
				comment_id : commentID,
				content : content
			},
		})
		.done(function(response) {
			// gửi thành công lên server
			if(response.status) { //nếu server edit comment thành công
				// update value
				$(obj).val(content)
				$(obj).prop("readonly" , "true")
			} else {
				toastr.error(response.message);
			}
		})
	}
});

//delete comment
$(document).on('click', '.delete-comment', function() {
	var obj = $(this)
	Swal.fire({
	  title: 'Do you want to delete this comment?',
	  showCancelButton: true,
	  confirmButtonText: `Delete`,
	}).then((result) => {
		/* Read more about isConfirmed, isDenied below */
		if (result.isConfirmed) {
		  	var commentID = $(this).attr('comment-id');
		  	var subCommentID = $(this).attr('sub-comment-id');
		  	if (subCommentID == null) {
		  		//delete parent comment
				url = document.URL + '/delete-comment';
			  	$.ajax({
					url: url,
					type: 'GET',
					data: {
						commentID: commentID
					},
				})
				.done(function(response) {
					// gửi thành công lên server
					if(response.status) { //nếu server xóa comment thành công
						// xóa comment trên giao diện
						let deleteObj = $(obj).parent().parent().parent();
						deleteObj.remove();
						var position = '.sub-comment-'+commentID

						//delete sub comment
						$(position).remove()
					}
				})
		  	} else {
		  		//delete sub comment
		  		url = document.URL + '/delete-sub-comment';
			  	$.ajax({
					url: url,
					type: 'GET',
					data: {
						commentID: commentID,
						subCommentID: subCommentID
					},
				})
				.done(function(response) {
					// gửi thành công lên server
					if(response.status) { //nếu server xóa comment thành công
						// xóa comment trên giao diện
						let deleteObj = $(obj).parent().parent().parent();
						deleteObj.remove();
					}
				})
		  	}	
		}
	})
})

//reply comment
$(document).on('click', '.reply-comment', function() {
	var commentorID = $('.comment-form .commentor').attr('commentor')
	var name = $('.comment-form .commentor span.name').text()
	var commentID = $(this).parents('.comment-item').attr('commentID')
	var position = '.sub-comment-'+commentID

	var html = '<div class="row reply-comment-form">'+
			    '<div class="col-lg-2 avatar-comment">'+
                '<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7c/User_font_awesome.svg/512px-User_font_awesome.svg.png" alt="">'+
                '<div class="commentor font-weight-bold" commentor="'+ commentorID +'">'+
                	'<span class="name">'+ name +'</span></div></div><div class="col-lg-10 content-comment">'+
                '<textarea type="text" name="" id="reply-comment-content" placeholder="input your comment..." parent-comment-id="'+commentID+'"></textarea>'+'</div></div>'
    $(position).append(html)
})

//reply sub comment
$(document).on('click', '.reply-sub-comment', function() {
	var commentorID = $('.comment-form .commentor').attr('commentor')
	var name = $('.comment-form .commentor span.name').text()
	var commentID = $(this).attr('comment-id')
	var position = '.sub-comment-'+commentID
	var html = '<div class="row reply-comment-form">'+
			    '<div class="col-lg-2 avatar-comment">'+
                '<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7c/User_font_awesome.svg/512px-User_font_awesome.svg.png" alt="">'+
                '<div class="commentor font-weight-bold" commentor="'+ commentorID +'">'+
                	'<span class="name">'+ name +'</span></div></div><div class="col-lg-10 content-comment">'+
                '<textarea type="text" name="" id="reply-comment-content" placeholder="input your comment..." parent-comment-id="'+commentID+'"></textarea>'+'</div></div>'
    $(position).append(html)
})

//edit comment
$(document).on('click', '.edit-comment', function() {
	let textarea = $(this).parents('.content-comment').find('textarea')
	$(this).parents('.content-comment').find('textarea').prop('readonly', false)
	$(this).parents('.content-comment').find('textarea').focus();
});

// fix lỗi đường dẫn khi submit trên modal
var route = window.location.href
$('#upload-document-modal').on('hidden.bs.modal', function (e) {
  	window.location.replace(route);
})