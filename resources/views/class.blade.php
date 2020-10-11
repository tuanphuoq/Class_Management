@extends('layouts.admin')
@section('content')
	<div class="row">
	  <div class="col-xs-12">
	    <div class="box">
	      <div class="box-header">
	        <h3 class="box-title">{{__('dict.class.class_manager')}}</h3>
	      </div>
	      <div class="box-body">
	      	{{-- nút tạo mới lớp học chỉ được hiển thị khi người dùng là admin hoặc teacher --}}
	       	@if(Auth::user()->role == 1 || Auth::user()->role == 2)
	       		<a data-toggle="modal" href='#class-modal' class="btn btn-sm btn-success">{{__('dict.class.add_class')}}</a>
	       	@endif
	       <div class="table-responsive">
	        <table class="table table-hover table-responsive">
	          <thead>
	            <tr>
	              <th>#</th>
	              <th>Class Name</th>
	              <th>Class Code</th>
	              <th>Subject</th>
	              <th>Room</th>
	              <th>Class Image</th>
	              <th>Action</th>
	            </tr>
	          </thead>
	          <tbody>
	           @if (isset($classrooms) && count($classrooms) > 0)
		           @foreach ($classrooms as $class)
		           <tr>
		           <td>{{$class->id}}</td>
		           <td>{{$class->class_name}}</td>
		           <td>{{$class->class_code}}</td>
		           <td>{{$class->subject}}</td>
		           <td>{{$class->room}}</td>
		           <td><img class="class-image" style="width: 50px; height: 50px;" src="{{ asset(\Storage::url($class->class_image)) }}"></td>
		           <td>
		           		@if(Auth::user()->role == 1 || Auth::user()->role == 2)
		            	<a data-toggle="modal" href='#class-modal' class="btn btn-warning btn-edit-class"
		            		class-id="{{$class->id}}" class-name="{{$class->class_name}}" subject="{{$class->subject}}" room="{{$class->room}}">Edit</a>
		             	<button class="btn btn-danger btn-delete-class" class-id="{{$class->id}}" creator-id="{{Auth::user()->id}}">Delete</button>
		             	@endif
		           </td>
		           </tr>
		          
		           @endforeach
	           @endif

	          </tbody>
	        </table>
	      </div>
	    </div>
	  </div>
	</div>
	</div>

	{{-- modal thay đổi quyền user --}}
	<div class="modal fade" id="class-modal">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title">{{__('dict.class.add_class')}}</h4>
	      </div>
	      <form method="POST" action="{{asset('')}}class/save" enctype="multipart/form-data">
	      <div class="modal-body">
	        @csrf
	        	<input type="hidden" class="form-control" value="" name="classID" required="required">
	        	<label>Class Name</label>
	        	<input type="text" class="form-control" id="" name="className" required="required">
	        	<label>Room</label>
	        	<input type="text" class="form-control" id="" name="classRoom" required="required">
	        	<label>Subject</label>
	        	<input type="text" class="form-control" id="" name="subject" required="required">
	        	<label>Class Image</label>
	        	<input type="file" class="form-control-file" id="" name="classFile" required="required">
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-primary btn-save" id="">{{__('dict.action.save')}}</button>
	      </div>
	    </div>
	    </form>
	  </div>
	</div>
@endsection

@section('foot')
	<script src="{{asset('')}}js/class.js"></script>
@endsection