<?php
namespace App\Helpers;
use App\Models\User;
use App\Helpers\GravaterHelper;



/**
 * Image helper classs
 */
class ImageHelper
{
	
	public static function getUserImage($id)
	{
		$user = User::find($id);
		$avater_url = "";
		if(!is_null($user)){
			if($user->avater == NULL){
				//return his or her gravater image
				if (GravaterHelper::validate_gravater($user->email)) {
					$avater_url = GravaterHelper::gravater_image($user->email, 100);
				}
				else{
					//when there is no gravater image
					$avater_url = url('frontend/images/defaults/avatar.png');
				}
			}
			else{
				//return that image
				$avater_url = url('frontend/images/users/'.$user->avater);
			}
		}
		else{
			//return redircet('/');
		}
		return $avater_url;
	}
}


?>