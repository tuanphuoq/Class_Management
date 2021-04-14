<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mail;

class MailSystem extends Model
{
    public static function sendMail($toUserMail, $option, $data)
    {
    	switch ($option) {
    		case "changerole":
    			//*======================================
		        // Mail::send 
		        // param1 : mail template to send
		        // param2 : data render for mail template
		        //*======================================
		        // $message->to(to mail address)->subject(this is main title of mail)
		        Mail::send('mail.changerole', array('name'=>$data["toName"], 'rolename'=>$data["roleName"]), function($message) use ($data){
			        $message->to($data['toEmail'], 'User System : '.$data["toName"])
			        ->subject('Notice of change of system permissions.');
			    });
		        //*======================================
    			break;
    		
    		case expr:
    			// code...
    			break;
    	}
    }
}
