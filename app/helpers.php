<?php 
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Model\CourseCategory;
use App\Model\CourseCatRelation;
use App\Model\Staff;
use App\Model\ParticipantLevel;
use App\Model\Authority;
use Illuminate\Support\Str;

  
    //Global Function for upload Single image
    function upload_file($file,$path)
    {
       $image = $file;
       $imagename = Str::slug($image->getClientOriginalName(), '-').'.'.$image->getClientOriginalExtension();
       $destinationPath = public_path($path);
       $image->move($destinationPath, $imagename);

       return $imagename;
    }

  	/**___ translate englist to hindi ___**/ 
	  	function language_translate($language_type, $get_english_text){ 

	        $apiKey = 'AIzaSyCYjghtMIGCbMCCI_YzN595LVQrZdsn2RY'; // live key
	               
	        $text = $get_english_text;
	        if ($language_type == 'Hindi') {

	          $lang_type = 'hi';

	        }elseif ($language_type == 'English') {
	          
	          $lang_type = 'en';

	        }else{

	          $lang_type = 'en';
	        }
	        
	        $url = 'https://www.googleapis.com/language/translate/v2?key=' . $apiKey . '&q=' . rawurlencode($text) . '&source=en&target='.$lang_type;

	        $handle = curl_init($url);
	        
	        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
	        
	        $response = curl_exec($handle);                 
	        
	        $responseDecoded = json_decode($response, true);
	        
	        curl_close($handle);

	        //d($responseDecoded);

	        return $responseDecoded['data']['translations'][0]['translatedText'];
	    }
    /**___End translate englist to hindi ___**/ 

?>