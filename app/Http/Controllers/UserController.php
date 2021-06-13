<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use Auth;
use App\MailSystem;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function list()
    {
    	if (Auth::user()->role == 1) {
			//lấy danh sách user từ database
			$list = User::all();
			//trả danh sách user về view user.blade.php để hiển thị
			return view('user', ['users' => $list]);
		} else {
			return redirect()->route('class.list');
		}
    }

    public function role(Request $req)
    {
    	//tìm user có id = $req->user
    	$user = User::find($req->user);
    	if(isset($user)) { //nếu tồn tại user có id = $req->user
    		//chỉnh sửa role của user = $req->role
    		$user->role = $req->role;
    		if($user->save()) { //nếu update role thành công
                //send mail
                $data['toName'] = $user->name;
                $data['toEmail'] = $user->email;
                $data['roleName'] = $this->getRoleName($req->role);
                MailSystem::sendMail($user->id, "changerole", $data);
    			//trả về thông báo thành công cho ajax
    			return response()->json([
    				'status' => true,
    				'message' => __('dict.role.role_success')
    			]);
    		} else {
    			// trả về thông báo thất bại cho ajax
    			return response()->json([
    				'status' => false,
    				'message' => __('dict.role.role_fail')
    			]);
    		}
    	} else { // không tìm đc user - trả về thông báo thất bại cho ajax
			return response()->json([
				'status' => false,
				'message' => __('dict.role.role_fail')
			]);
		}
    }

    public function getRoleName($roleID)
    {
        if ($roleID == 1) {
            return "ADMIN";
        }
        if ($roleID == 2) {
            return "Teacher";
        }
        if ($roleID == 3) {
            return "Student";
        }
    }

	public function changePassword()
	{
		return view('password');
	}

	public function savePassword(Request $req)
	{
		if ($req->oldPass == "") {
            $message = "Mật khẩu cũ không được để trống";
			return redirect()->route('changepassword')->with('error', $message);
        } else if ($req->newPass == "" || $req->rePass == "") {
            $message = "Mật khẩu mới và mật khẩu xác nhận không được để trống";
			return redirect()->route('changepassword')->with('error', $message);
        } else if ($req->newPass != $req->rePass) {
            $message = "Xác nhận mật khẩu không đúng";
			return redirect()->route('changepassword')->with('error', $message);
        } else {
            // if (Auth::user()->password == Hash::make($req->oldPass)) {
            if (Hash::check($req->oldPass, Auth::user()->password)) {
				$user = User::find(Auth::user()->id);
				$user->password = Hash::make($req->newPass);
				$user->save();
				$message = "Cập nhật mật khẩu thành công";
				// success
				return redirect()->route('changepassword')->with('success', $message);
			} else {
				$message = "Sai mật khẩu để cập nhật mật khẩu mới";
				return redirect()->route('changepassword')->with('error', $message);
			}
        }
	}
}
