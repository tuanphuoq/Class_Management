<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Auth;
use Storage;
use App\Comment;
use App\SubComment;
use Carbon\Carbon;

class CommentController extends Controller
{
	// hàm lưu trữ file upload
    public function storeDocument($file, $fileName)
    {
		$disk = 'public';
		$path=$file->storeAs('documents', $fileName, $disk);
		return $path;
	}

    public function addSubComment(Request $req)
    {
    	$subComment['parent_comment_id'] = $req->parent_id;
    	$subComment['content'] = $req->content;
    	$subComment['commentor'] = Auth::user()->id;
		if (!is_null($req->file('attachment'))) {
			$file = $req->file('attachment');
			//upload file lên server
			$fileName = strtotime(Carbon::now()->toDateTimeString())."-".$file->getClientOriginalName();
			$subComment['attachment'] = $this->storeDocument($file, $fileName);
		}
    	if ($result = SubComment::create($subComment)) {
    		return response()->json([
				'status' => true,
				'message' => "success",
				'id' => $result->id,
				'attachment' => $subComment['attachment']
			]);
    	} else {
    		return response()->json([
				'status' => false,
				'message' => "Have error while add new sub comment"
			]);
    	}
    }

    public function deleteSubComment(Request $req)
    {
    	if (SubComment::where('parent_comment_id', $req->commentID)->where('id', $req->subCommentID)->delete()) {
    		return response()->json([
				'status' => true,
				'message' => "success"
			]);
    	} else {
    		return response()->json([
				'status' => false,
				'message' => "Have error while delete sub comment"
			]);
    	}
    }

    public function editSubComment(Request $req)
	{
		$subComment = SubComment::find($req->sub_comment_id);
		if ($subComment) {
			$subComment->content = $req->content;
			if ($subComment->save()) {
				return response()->json(['status' => true]);
			} else {
				return response()->json([
					'status' => false,
					'message' => 'Edit sub comment failed'
				]);
			}
		} else {
			return response()->json([
				'status' => false,
				'message' => 'Edit sub comment failed'
			]);
		}
	}
}
