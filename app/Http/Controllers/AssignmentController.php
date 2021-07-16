<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Auth;
use Storage;
use Carbon\Carbon;
use App\User;
use App\Classroom;
use App\Assignment;
use App\AssignmentSubmit;
use App\AssignmentDocument;

class AssignmentController extends Controller
{
	public function get($assignmentID)
	{
		$classID = Assignment::find($assignmentID)->value('class_id');
		$class = Classroom::find($classID);
		$assignment = Assignment::find($assignmentID);
		$assDocument = AssignmentDocument::where('assignment_id', $assignmentID)->orderBy('created_at', 'DESC')->get();
		$assignmentList = AssignmentSubmit::select(
			'users.id as user_id',
			'users.name',
			'users.email',
			'assignment_submits.id',
			'assignment_submits.description',
			'assignment_submits.file',
			'assignment_submits.updated_at',
			'assignment_submits.created_at',
		)
		->join('users', 'users.id', '=', 'assignment_submits.user_id')
		->where('assignment_id', $assignmentID)
		->orderBy('updated_at', 'DESC')
		->get();
		// check expired_date
		$now = Carbon::now();
		$check = new Carbon($assignment->expired_date);
		if ($now <= $check) {
			$submit = true;
		} else {
			$submit = false;
		}
		return view('assignment', [
			'class' => $class,
			'assignment' => $assignment,
			'submit' => $submit,
			'assignmentList' => $assignmentList,
			'assDocument' => $assDocument,
		]);
	}

    public function save($classID, Request $req)
    {
    	if ($req->assignment_id == null) {
    		//add new
    		$assignment['class_id'] = $classID;
    		$assignment['title'] = $req->title;
    		$assignment['description'] = $req->description;
    		$date = new Carbon($req->expired);
    		$assignment['expired_date'] = $date->toDateString();
    		Assignment::create($assignment);
    		//reload
    		return redirect()->route('myclass', $classID);
    	} else {
    		//edit
    		$assignment = Assignment::find($req->assignment_id);
    		$assignment['title'] = $req->title;
    		$assignment['description'] = $req->description;
    		$date = new Carbon($req->expired);
    		$assignment['expired_date'] = $date->toDateString();
    		$assignment->save();
    		//reload
    		return redirect()->route('myclass', $classID);
    	}
    }

    public function upload($assignmentID, Request $req)
    {
		if ($req->assignment_submit_id) {
			//edit
			$assSub = AssignmentSubmit::find($req->assignment_submit_id);
			if ($req->file('assignmentFile')) {
				//have file - delete old file
				Storage::disk('public')->delete($assSub->file);
				//add new file
				$file = $req->file('assignmentFile');
				$fileName = strtotime(Carbon::now()->toDateTimeString())."-".$file->getClientOriginalName();
				$assSub->file = $this->storeDocument($file, $fileName);
				$assSub->description = $req->description;
				$assSub->save();
			} else {
				//have not file
				$assSub->description = $req->description;
				$assSub->save();
			}
		} else {
			//create
			$record['assignment_id'] = $assignmentID;
			$record['description'] = $req->description;
			$record['user_id'] = Auth::user()->id;
			$file = $req->file('assignmentFile');
			//chưa có - upload file lên server
			$fileName = strtotime(Carbon::now()->toDateTimeString())."-".$file->getClientOriginalName();
			$record['file'] = $this->storeDocument($file, $fileName);
			//create record
			AssignmentSubmit::create($record);
		}
		// callback giao diện assignment
		return redirect()->route('assignment', $assignmentID);
    }

	// update document for assignment
    public function uploadDocument($assignmentID, Request $req)
    {

		//create
		$record['assignment_id'] = $assignmentID;
		$record['title'] = $req->title;
		$file = $req->file('documentFile');
		//upload file lên server
		$fileName = strtotime(Carbon::now()->toDateTimeString())."-assignment-".$file->getClientOriginalName();
		$record['url'] = $this->storeDocument($file, $fileName);
		//create record
		AssignmentDocument::create($record);

		// callback giao diện assignment
		return redirect()->route('assignment', $assignmentID);
    }

    // hàm lưu trữ file upload
    public function storeDocument($file, $fileName)
    {
		$disk = 'public';
		$path=$file->storeAs('assignments', $fileName, $disk);
		return $path;
	}

	public function deleteSubmit(Request $req)
	{
		$assSub = AssignmentSubmit::find($req->id);
		//delete file in storage
		Storage::disk('public')->delete($assSub->file);
		//delete record
		if ($assSub->delete()) {
			return response()->json([
				'status' => true
			]);
		} else {
			return response()->json([
				'status' => false
			]);
		}
	}
}
