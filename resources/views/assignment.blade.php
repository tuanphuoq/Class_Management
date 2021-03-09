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
			      </div>
	      	</div>
	      	<div class="col-lg-6 group-btn text-right">
	      		@if(Auth::user()->role == 2 || Auth::user()->role == 1)
	      		{{-- <a data-toggle="modal" href='#request-modal' class="btn btn-box-header btn-success" id="btn-student-list">
	      			<?php $sum =0 ?>
	      			Request Join <span class="badge badge-secondary">{{isset($sum) ? $sum : 0}}</span>
	      		</a>
	      		<a data-toggle="modal" href='#add-student-modal' class="btn btn-box-header btn-success">
	      			Add Student  &nbsp;<i class="fa fa-plus" aria-hidden="true"></i>
	      		</a> --}}
	      		<a data-toggle="modal" href='#upload-assignment-modal' class="btn btn-box-header btn-success" id="edit-assignment"><i class="fa fa-plus-circle" aria-hidden="true"></i> Edit Assignment</a>
	      		@endif
	      		{{-- <a data-toggle="modal" href='#class-modal' class="btn btn-box-header btn-success" id="btn-student-list" role="{{Auth::user()->role}}">
	      			Student List  &nbsp;<i class="fa fa-users" aria-hidden="true"></i>
	      		</a> --}}
	      	</div>
	      </div>
	      <div class="box-body">
	      	<div class="teacher-name">Assignment : <span class="name">{{$assignment->title}}</span></div>
	      	<div class="teacher-name des"><i class="fa fa-calendar-times-o" aria-hidden="true"></i> Expired Date : <span class="name text-danger">{{$assignment->expired_date}}</span></div>
	      	<div class="des">Description : {{$assignment->description}}</div>
	      	<hr>
	      	<div>
	      		<div>
	      			<button class="btn btn-box-header btn-success" data-toggle="modal" href='#upload-document-modal'
	      				@if($submit == false) disabled="disabled" @endif>
		      			<i class="fa fa-paper-plane" aria-hidden="true"></i> Submit your assignment 
		      		</button>
		      		@if($submit == false)
		      			<h5 class="text-danger">past due date</h5>
		      		@endif
		      	</div>
	      		<h4>list of submitted : </h4>
	      		<div>
	      			<ul id="submit-list">
	      				<?php $index = 1 ?>
	      				{{-- //foreach --}}
	      				@foreach ($assignmentList as $item)
	      			    <li>
	      			    	<div class="submit-list row">
	      			    		<div class="index">
		      			    		{{$index}} 
		      			    		<div class="ass-btn">
		      			    			@if (Auth::user()->id == $item->user_id)
		      			    			<a class="btn-warning1" data-toggle="modal" href='#upload-document-modal' id="edit-assignment" 
		      			    				des="{{$item->description}}" assignment-submit-id="{{$item->id}}">
		      			    				<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
		      			    			</a>
		      			    			<a class="btn-danger1 pointer delete-assignment-submit" assignment-submit-id="{{$item->id}}">
		      			    				<i class="fa fa-trash" aria-hidden="true"></i>
		      			    			</a>
		      			    			@endif
		      			    		</div>
		      			    	</div>
	      			    		<div class="name"><i class="fa fa-user-circle" aria-hidden="true"></i> {{$item->name}}</div>
	      			    		<div class="email"><i class="fa fa-envelope-o" aria-hidden="true"></i> {{$item->email}}</div>
	      			    		<div class="file"><i class="fa fa-file-o" aria-hidden="true"></i> <a href="{{asset('')}}download/{{$item->file}}" > {{$item->file}}</a></div>
	      			    		<div class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> {{$item->updated_at}}</div>
	      			    		<div class="description"><i class="fa fa-info-circle" aria-hidden="true"></i> {{$item->description}}</div>
	      			    	</div>
	      			    </li>
	      			    <?php $index++ ?>
	      			    @endforeach
	      			    {{-- end --}}
	      			</ul>
	      		</div>
	      	</div>
	      </div>
	    </div>
	  </div>
	</div>

	{{-- modal xem danh sách học viên --}}
	{{-- <div class="modal fade" id="class-modal">
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
	</div> --}}

	{{-- modal upload tài liệu --}}
	<div class="modal fade" id="upload-document-modal">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title">Upload Assignment</h4>
	      </div>
	      <form method="POST" action="{{asset('')}}assignment/{{$assignment->id}}/upload" enctype="multipart/form-data">
	      	{{-- add new document : action + upload --}}
	      	{{-- edit document : action + edit-document --}}
	      <div class="modal-body">
	        @csrf
	        	<input type="hidden" name="assignment_submit_id" value="">
	        	<label>Description</label>
	        	<input type="text" class="form-control" id="" name="description">
	        	<label>Assignment File</label>
	        	<input type="file" class="form-control-file" id="" name="assignmentFile" required>
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
	        	<input type="hidden" name="assignment_id" value="{{$assignment->id}}">
	        	<label>Title</label>
	        	<input type="text" class="form-control" id="" name="title" required="required" value="{{$assignment->title}}">
	        	<label>Expired Date</label>
	        	<input type="text" class="form-control datepicker" id="" name="expired" required="required" readonly="readonly" value="{{$assignment->expired_date}}">
	        	<label>Description</label>
	        	<input type="text" class="form-control" id="" name="description" required="required" value="{{$assignment->description}}">
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
@endsection

@section('foot')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script src="{{asset('')}}js/class_detail.js"></script>
@endsection