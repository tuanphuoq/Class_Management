<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use App\User;
use App\Classroom;

class ClassController extends Controller
{
    public function list()
    {
    	$classrooms = Classroom::all();
    	return view('class', ['classrooms' => $classrooms]);
    }

    public function create()
    {
    	return view('add_class');
    }

    public function save(Request $req)
    {
    	//nếu tồn tại class_id tức là sửa class
    	if(isset($req->classID)) { //check tồn tại classID từ phía client
    		$class = Classroom::find($req->classID);
    		if(isset($class)) {
    			//gán các giá trị mới
    			$class->class_name = $req->className;
	    		$class->room = $req->classRoom;
	    		$class->subject = $req->subject;
	    		// trong trường hợp edit mà muốn sửa lại file hình ảnh thì mới thực hiện thay đổi ảnh
	    		if(isset($req->classFile)) {
	    			$class->class_image = $this->saveImg($req);
	    		}
	    		// lưu dữ liệu mới
	    		$class->save();
	    		return $this->list();
    		} else {
    			return $this->list();
    		}
    	} else {
    		//nếu không tồn tại class_id tức là tạo mới class
    		$class['class_code'] = $this->getCode(); //tạo code class
    		// Auth::user()->id để xác định người tạo lớp
    		$class['creator_id'] = Auth::user()->id;
    		$class['class_name'] = $req->className;
    		$class['room'] = $req->classRoom;
    		$class['subject'] = $req->subject;
    		$class['class_image'] = $this->saveImg($req);
    		$result = Classroom::create($class);
    		return $this->list();
    	}
    }

    // hàm upload ảnh lên server
    public function saveImg($req)
    {
		$disk = 'public';
		$extension = $req->file('classFile')->extension();
		$path=$req->classFile->storeAs('images','class-'.time().'.'.$extension, $disk);
		return $path;
	}

	//hàm kiểm tra trùng class_code
	public function getCode()
	{
		while(true) {
			$code = $this->codeRandom();
			$class = Classroom::where('class_code', $code)->get();
			if(!isset($class) || count($class) < 1) {
				return $code;
			}
		};
	}

	//hàm tạo code random cho class_code
	public function codeRandom()
	{
		$pin = mt_rand(1000, 9999);
		// shuffle the result
		$string = 'ID'.str_shuffle($pin);
		return $string;
	}

	public function delete(Request $req)
	{
		$class = Classroom::find($req->classID);
		// dd($class);
		if($class->creator_id == $req->creatorID) {
			// đây là người tạo ra lớp
			$class->delete();
			return response()->json([
				'status' => true,
				'message' => __('dict.class.delete_success')
			]);
		} else {
			// đây không phải là người tạo lớp
			return response()->json([
				'status' => false,
				'message' => __('dict.class.delete_fail')
			]);
		}
	}
}
