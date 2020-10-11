<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;

class UserController extends Controller
{
    public function list()
    {
    	$list = User::all();
    	return view('user', ['users' => $list]);
    }

    public function role(Request $req)
    {
    	$user = User::find($req->user);
    	if(isset($user)) {
    		$user->role = $req->role;
    		if($user->save()) {
    			return response()->json([
    				'status' => true,
    				'message' => __('dict.role.role_success')
    			]);
    		} else {
    			return response()->json([
    				'status' => false,
    				'message' => __('dict.role.role_fail')
    			]);
    		}
    	} else {
			return response()->json([
				'status' => false,
				'message' => __('dict.role.role_fail')
			]);
		}
    }
}
