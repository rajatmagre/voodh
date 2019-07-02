<?php
/*
	Created By Kp
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Session;
use Validator;
use App\Model\User;
use App\Model\AccidentTrack;
use Mail;
use Illuminate\Support\Facades\DB;


class NotificationController extends Controller
{
        /*___ push notifictation send for IOS ___*/ 
	    protected function push_notification_ios($device_token,$title,$subtitle,$alert_msg,$accident_id='') {
	        
    	   // Put your device token here (without spaces):
	        $deviceToken = $device_token;
	        // Put your private key's passphrase here:
	        $passphrase = '';

	        $ctx     = stream_context_create();
	        $pem_url = "Certificates.pem";

	        // dd($pem_url); 
	        stream_context_set_option($ctx, 'ssl', 'local_cert', $pem_url);
	        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

	        // Open a connection to the APNS server
	        $fp = stream_socket_client(
	            'ssl://gateway.sandbox.push.apple.com:2195', $err,
	            $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx
	        );

	        if (!$fp)
	          exit("Failed to connect: $err $errstr" . PHP_EOL);

	        //echo 'Connected to APNS' . PHP_EOL;

			$payload = json_encode([
	              'aps' => [
	                  'alert' => [
	                          'title'=> $title, 
	                          'subtitle'=> $subtitle, 
	                          'body'=> $alert_msg
	                        ],
	                  'accident_id' => $accident_id,
	                  'sound' => 'default',
	                  "category" => "CustomSamplePush",
	                  'attachment-url'=> "https://pusher.com/static_logos/320x320.png",
	                  'badge' => 1
	              ]
	          ]);
	        // Build the binary notification
	        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

	        // Send it to the server
	        // $result = fwrite($fp, $msg, strlen($msg));
	        // print_r($payload);die;

	        try {  
	            sleep(10);                         
	            $result = fwrite($fp, $msg, strlen($msg));
	        }
	        catch (Exception $ex) {

	           	// echo "test";
	              // try once again for socket busy error (fwrite(): SSL operation failed with code 1.
	              // OpenSSL Error messages:\nerror:1409F07F:SSL routines:SSL3_WRITE_PENDING)
	            sleep(10); //sleep for 5 seconds
	            $result = fwrite($fp, $msg, strlen($msg));
	            if ($result)
	            {
	                return true;
	            }
	            else {
	                return false;
	            }
	        }
	        return $payload;
	        if (!$result)
	          return 'Message not delivered' . PHP_EOL;
	        else
	          return 'Message successfully delivered' . PHP_EOL;

	        // Close the connection to the server
	        fclose($fp);
	    }

	
}
