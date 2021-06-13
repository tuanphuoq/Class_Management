@extends('layouts.admin')
@section('css')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />
	<link rel="stylesheet" href="{{asset('../css/class_detail.css')}}">
@endsection
@section('content')
	<div class="row">
	  <div class="col-xs-12">
	    <div class="box">
	      <div class="row">
	      	<div class="col-lg-6">
	      		<div class="box-header">
			        <h3 class="box-title">Class name : {{$class->class_name}}</h3>
			        <h3 class="box-title">Class code : {{$class->class_code}}</h3>
			        <h3 class="box-title">Subject : {{$class->subject}}</h3>
			        <h3 class="box-title">Room : {{$class->room}}</h3>
					<?php $class_status = [
						0 => 'Deleted',
						1 => 'Is Active',
						2 => 'Finished',
					]; ?>
					<h3 class="box-title">Status :
						<span class="{{$class->status == 1 ? 'text-success' : 'text-danger'}}">
							<i class="fa fa-circle" aria-hidden="true"></i> {{$class_status[$class->status]}}
						</span>
					</h3>
			      </div>
	      	</div>
	      	<div class="col-lg-6 group-btn text-right">
	      		@if((Auth::user()->role == 2 || Auth::user()->role == 1) && $class->status == 1)
	      		{{-- <button class="btn btn-box-header">tét</button> --}}
	      		<a data-toggle="modal" href='#request-modal' class="btn btn-box-header btn-success" id="btn-student-list">
	      			Request Join <span class="badge badge-secondary">{{isset($sum) ? $sum : 0}}</span>
	      		</a>
	      		<a data-toggle="modal" href='#add-student-modal' class="btn btn-box-header btn-success">
	      			Add Student  &nbsp;<i class="fa fa-plus" aria-hidden="true"></i>
	      		</a>
	      		<a data-toggle="modal" href='#change-status' class="btn btn-box-header btn-success btn-delete-class" class-id="{{$class->id}}" 
	      			creator-id="{{Auth::user()->id}}" class-name="{{$class->class_name}}">
	      			Change Status  &nbsp;<i class="fa fa-refresh" aria-hidden="true"></i>
	      		</a>
	      		@endif
	      		<a data-toggle="modal" href='#class-modal' class="btn btn-box-header btn-success" id="btn-student-list" role="{{Auth::user()->role}}">
	      			Student List  &nbsp;<i class="fa fa-users" aria-hidden="true"></i>
	      		</a>
	      	</div>
	      </div>
	      <div class="box-body">
	      	<div class="teacher-name">Teacher : <span class="name">{{$class->teacher_name}}</span></div>
	      	<div>
	      		<div><span class="text-danger">(*)</span> This description of subject : {{$class->description ? $class->description : ""}}</div>
	      		<div><span class="text-danger">(*)</span> Make sure to complete assignments requested by the teacher in the assignment area</div>
	      		<div><span class="text-danger">(*)</span> All references of the subject are updated by the teacher in the documentation area</div>
	      		<div><span class="text-danger">(*)</span> Any questions about the topic can leave comments in the comments</div>
	      	</div>
	      	<hr>
	      	<div class="document-title">Assignments <i class="fa fa-briefcase" aria-hidden="true"></i></div>
	      	<div class="document-list">
	      		<div class="assignment-row">
	      		@if(isset($assignments) && count($assignments) > 0)
	      		@foreach($assignments as $item)
	      			<a class="assignment-item my-1" href="{{asset('')}}assignment/{{$item->id}}">
	      				<i class="fa fa-folder-open-o" aria-hidden="true"></i> {{$item->title}}
	      			</a>
	      		@endforeach
	      		@endif
	      		</div>
	      		@if((Auth::user()->role == 1 || Auth::user()->role == 2) && $class->status == 1)
	      		<div class="document-item">
	      			<a data-toggle="modal" href='#upload-assignment-modal' class="btn btn-success" id="add-assignment"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Assignment</a>
	      		</div>
	      		@endif
	      	</div>
	      	
	      	<hr>
	      	<div class="document-title">Documents <i class="fa fa-file-text" aria-hidden="true"></i></div>
	      	<div class="document-list">
	      		@if(isset($documents) && count($documents) > 0)
	      		@foreach($documents as $item)
	      		<div class="document-item py-1">
	      			<h5>description : {{$item->description}}</h5>
	      			<i class="fa fa-book" aria-hidden="true"></i><a href="{{asset('')}}download/{{$item->source}}" > {{$item->source}}</a>
	      			@if(Auth::user()->role == 1 || Auth::user()->role == 2)
	      			<div>
	      				<span>{{$item->updated_at}}</span>&nbsp;
	      				<a class="text-warning edit-document" data-toggle="modal" href='#upload-document-modal' 
	      					description="{{$item->description}}" document-id="{{$item->id}}">
	      					<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
	      				</a>
	      				&nbsp;<button class="text-danger delete-document" document-id="{{$item->id}}">
	      					<i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
	      			</div>
	      			@endif
	      		</div>
	      		@endforeach
	      		@endif
	      		@if(Auth::user()->role == 1 || Auth::user()->role == 2)
	      		<div class="document-item">
	      			<a data-toggle="modal" href='#upload-document-modal' class="btn btn-success" id="add-document"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Document</a>
	      		</div>
	      		@endif
	      	</div>
	      	<hr>
	      	<div class="comment-section">
	      		<div class="document-title">Comment <i class="fa fa-comments" aria-hidden="true"></i></div>
	      		<div class="wrap-comment">
	      			{{-- <div class="comment-form row">
			            <div class="col-lg-2 avatar-comment">
			                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7c/User_font_awesome.svg/512px-User_font_awesome.svg.png" alt="">
			                <div class="commentor font-weight-bold" commentor="{{Auth::user()->id}}">
			                	@if(Auth::user()->role == 1 || Auth::user()->role == 2)
			                	<span class="admin">ADMIN</span>
			                	@endif
			                	{{Auth::user()->name}}
			                </div>
			            </div>
			            <div class="col-lg-10 content-comment">
			                <textarea type="text" name="" id="comment-content" placeholder="input your comment..."></textarea>
			            </div>
			        </div> 
	      			<hr id="hr"> --}}
	      			@if(isset($comments))
	      			@foreach($comments as $item)
				        <div class="comment-item row" commentID="{{$item->id}}">
				            <div class="col-lg-2 col-md-2 col-xs-4 avatar-comment">
				                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7c/User_font_awesome.svg/512px-User_font_awesome.svg.png" alt="">
				                <div class="commentor font-weight-bold" commentor="{{$item->commentor}}">
				                	@if($item->role == 1)
				                	<span class="admin">ADMIN</span>
				                	@elseif($item->role == 2)
				                	<span class="admin">TEACHER</span>
				                	@endif
				                	{{$item->name}}
				            	</div>
				            </div>
				            <div class="col-lg-10 col-md-10 col-xs-8 content-comment">
				                <textarea type="text" name="" class="edit-commented" readonly="readonly" comment-id="{{$item->id}}">{{$item->content}}</textarea>
				                <div class="action">
				                    <span>At {{$item->updated_at}}</span>
									@if ($class->status == 1)
										<span class="text-info reply-comment px-1" comment-id="{{$item->id}}">Reply</span>
										@if(Auth::user()->id == $item->commentor)
										<span class="text-warning edit-comment px-1" comment-id="{{$item->id}}">Edit</span>
										@endif
										@if(Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->id == $item->commentor)
										<span class="text-danger delete-comment px-1" comment-id="{{$item->id}}">Delete</span>
										@endif
									@endif
				                </div>
				            </div>
				        </div>

				        <div class="sub-comment-{{$item->id}}">
				        @if(isset($item->subComment))
				        	@foreach($item->subComment as $item1)
					        	<div class="row reply-comment-form">
								    <div class="col-lg-2 avatar-comment">
					                	<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7c/User_font_awesome.svg/512px-User_font_awesome.svg.png" alt="">
						                <div class="commentor font-weight-bold" commentor="{{$item1->commentor}}">
						                	@if($item1->role == 1)
						                	<span class="admin">ADMIN</span>
						                	@elseif($item1->role == 2)
						                	<span class="admin">TEACHER</span>
						                	@endif
						                	{{$item1->name}}
						            	</div>
					            	</div>
						            <div class="col-lg-10 content-comment">
						                <textarea type="text" name="" id="reply-comment-content" readonly="readonly" parent-comment-id="{{$item->id}}" sub-comment-id="{{$item1->id}}">{{$item1->content}}</textarea>
					                	<div class="action">
						                    <span>At {{$item1->updated_at}}</span>
											@if ($class->status == 1)
												<span class="text-info reply-sub-comment px-1" sub-comment-id="{{$item1->id}}" comment-id={{$item->id}}>Reply</span>
												@if(Auth::user()->id == $item1->commentor)
												<span class="text-warning edit-comment px-1" sub-comment-id="{{$item1->id}}" comment-id={{$item->id}}>Edit</span>
												@endif
												@if(Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->id == $item1->commentor)
												<span class="text-danger delete-comment px-1" comment-id="{{$item->id}}" sub-comment-id="{{$item1->id}}">Delete</span>
												@endif
											@endif
						                </div>
						            </div>
					            </div>
				            @endforeach
				        @endif
				        </div>
			        @endforeach
			        @endif
					@if ($class->status == 1)
			        <hr id="hr">
			        <div class="comment-form row">
			            <div class="col-lg-2 avatar-comment">
			                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7c/User_font_awesome.svg/512px-User_font_awesome.svg.png" alt="">
			                <div class="commentor font-weight-bold" commentor="{{Auth::user()->id}}">
			                	@if(Auth::user()->role == 1)
			                	<span class="admin">ADMIN</span>
			                	@elseif($item->role == 2)
			                	<span class="admin">TEACHER</span>
			                	@endif
			                	<span class="name">{{Auth::user()->name}}</span>
			                </div>
			            </div>
			            <div class="col-lg-10 content-comment">
			                <textarea type="text" name="" id="comment-content" placeholder="input your comment..."></textarea>
			            </div>
			        </div>
					@endif
			        {{-- <div class="comment-form row reply-comment-form">
			            <div class="col-lg-2 avatar-comment">
			                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7c/User_font_awesome.svg/512px-User_font_awesome.svg.png" alt="">
			                <div class="commentor font-weight-bold" commentor="{{Auth::user()->id}}">
			                	@if(Auth::user()->role == 1 || Auth::user()->role == 2)
			                	<span class="admin">ADMIN</span>
			                	@endif
			                	<span class="name">{{Auth::user()->name}}</span>
			                </div>
			            </div>
			            <div class="col-lg-10 content-comment">
			                <textarea type="text" name="" id="comment-content" placeholder="input your comment..."></textarea>
			            </div>
			        </div> --}}
			    </div>
	      	</div>

	      {{-- test new ui --}}
	      <div class="wrap">
	      	@if (isset($classrooms) && count($classrooms) > 0)
		           @foreach ($classrooms as $class)
	      	<div class="col-lg-2 col-md-4 class-item">
	      		<div class="body-class-img" style="background-image: url('{{ asset(\Storage::url($class->class_image)) }}');"></div>
	      		<div class="header-class">
	      			<h6>Class Name : {{$class->class_name}}</h6>
	      			<h6>Code : {{$class->class_code}}</h6>
	      			<h6>Room : {{$class->room}}</h6>
	      		</div>
	      		<h6 class="body-subject">Subject : {{$class->subject}}</h6>
	      		@if(Auth::user()->role == 1 || Auth::user()->role == 2)
	      		<div class="class-action">
	      			<a data-toggle="modal" href='#class-modal' class="btn btn-warning btn-edit-class"
	            		class-id="{{$class->id}}" class-name="{{$class->class_name}}" subject="{{$class->subject}}" room="{{$class->room}}">Edit</a>
	             	<button class="btn btn-danger btn-delete-class" class-id="{{$class->id}}" creator-id="{{Auth::user()->id}}">Delete</button>
	      		</div>
	      		@endif
	      	</div>
	      	@endforeach
	           @endif
	      </div>
	    </div>
	  </div>
	</div>
	</div>

	{{-- modal xem danh sách học viên --}}
	<div class="modal fade" id="class-modal">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title">Student List</h4>
	      </div>
	      <div class="modal-body">
	        <div class="table-responsive">
		        <table class="table table-hover table-responsive">
		          <thead>
		            <tr>
		              <th>Index</th>
		              <th>Student Name</th>
		              <th>Email</th>
		              @if(Auth::user()->role == 1 || Auth::user()->role == 2)
		              <th>Action</th>
		              @endif
		            </tr>
		          </thead>
		          <tbody id="student-list-body"></tbody>
		        </table>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-primary btn-save" id="" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	{{-- modal xác nhận yêu cầu tham gia từ học viên --}}
	<div class="modal fade" id="request-modal">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title">Invitation List</h4>
	      </div>
	      <div class="modal-body">
	        <div class="table-responsive">
		        <table class="table table-hover table-responsive">
		          <thead>
		            <tr>
		              <th>Index</th>
		              <th>Student Name</th>
		              <th>Action</th>
		            </tr>
		          </thead>
		          <tbody id="student-list-body">
		          	@if(isset($data))
		          		@foreach($data as $value)
		          		<tr>
		          			<td>{{$value->student_id}}</td>
		          			<td>{{$value->name}}</td>
		          			<td><button request-id="{{$value->id}}" class="btn btn-success accept-request">Accept</button></td>
		          		</tr>
		          		@endforeach
		          	@endif
		          </tbody>
		        </table>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-primary btn-save" id="" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	{{-- modal thêm học viên --}}
	<div class="modal fade" id="add-student-modal">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title">Add student to classroom</h4>
	      </div>
	      <div class="modal-body">
	        <div>Enter the student's mail to add to classroom</div>
	        <input type="text" class="form-control" id="student-email">
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-primary btn-danger" id="" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary btn-success" id="btn-add-student" teacher-id="{{Auth::user()->id}}">Add</button>
	      </div>
	    </div>
	  </div>
	</div>

	{{-- modal upload tài liệu --}}
	<div class="modal fade" id="upload-document-modal">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title">Upload Document</h4>
	      </div>
	      <form method="POST" action="{{asset('')}}my-class/{{$class->id}}/" enctype="multipart/form-data">
	      	{{-- add new document : action + upload --}}
	      	{{-- edit document : action + edit-document --}}
	      <div class="modal-body">
	        @csrf
	        	<input type="hidden" name="document_id" value="">
	        	<label>Description</label>
	        	<input type="text" class="form-control" id="" name="description" required="required">
	        	<label>Document File</label>
	        	<input type="file" class="form-control-file" id="" name="classFile" required>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-primary btn-save" id="">{{__('dict.action.save')}}</button>
	      </div>
	      </form>
	    </div>
	  </div>
	</div>

	{{-- modal upload bài tập --}}
	<div class="modal fade" id="upload-assignment-modal">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title">Assignment</h4>
	      </div>
	      <form method="POST" action="{{asset('')}}my-class/{{$class->id}}/assignment/save" enctype="multipart/form-data">
	      	{{-- add new document : action + upload --}}
	      	{{-- edit document : action + edit-document --}}
	      <div class="modal-body">
	        @csrf
	        	<input type="hidden" name="assignment_id" value="">
	        	<label>Title</label>
	        	<input type="text" class="form-control" id="" name="title" required="required">
	        	<label>Expired Date</label>
	        	<input type="text" class="form-control datepicker" id="" name="expired" required="required" readonly="readonly">
	        	<label>Description</label>
	        	<input type="text" class="form-control" id="" name="description" required="required">
	        	{{-- <label>Document File</label>
	        	<input type="file" class="form-control-file" id="" name="assignmentFile" required> --}}
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-primary btn-save" id="">{{__('dict.action.save')}}</button>
	      </div>
	      </form>
	    </div>
	  </div>
	</div>

	{{-- modal tạo mới, sửa class --}}
	<div class="modal fade" id="change-status">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title">{{__('dict.class.change_status_class')}}</h4>
	      </div>
	      <form>
	      <div class="modal-body">
	        @csrf
	        	<input type="hidden" class="form-control" value="" name="classID" required="required">
	        	<input type="hidden" class="form-control" value="" name="creatorID" required="required">
	        	<label>Class Name</label>
	        	<input type="text" class="form-control" id="" name="className" required="required" readonly="readonly">
	        	<label>Status</label>
	        	<select class="form-control" id="status-list">
	        		<option value="1">Classroom is open</option>
	        		<option value="2">Classroom finished</option>
	        		<option value="0">Soft delete this classroom</option>
	        	</select>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary btn-save">{{__('dict.action.save')}}</button>
	      </div>
	    </div>
	    </form>
	  </div>
	</div>
@endsection

@section('foot')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script src="{{asset('')}}js/class_detail.js"></script>
@endsection