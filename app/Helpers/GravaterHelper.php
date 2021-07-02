<?php
namespace App\Helpers;
/**
 * gravater image
 *
 * @return this class is showing gravater image to check all possibilities
 */
class GravaterHelper
{
	/**
	 * @param string $email for User
	 * @return boolean true if there has any images false otherwise
	 */
	public static function validate_gravater($email)
	{
		$hash = md5($email);
		$uri = 'https://s.gravatar.com/avatar/' . $hash . '?d=404';
		$headers = @get_headers($uri);
		if(!preg_match("[200]", $headers[0])){
			$has_valid_avater = FALSE;
		}
		else{
			$has_valid_avater = TRUE;
		}
		return $has_valid_avater;
	}


	/**
	 * Gravater Image
	 *
	 * Get the avater image from the email address
	 * 
	 * @param string $email for User
	 * @return integer $size size of image
	 * @return string $d type of image if not gravater image
	 * @return string gravater image URL
	 */
	public static function gravater_image($email, $size = 0, $d = "")
	{
		$hash = md5($email);
		$image_url = 'https://s.gravatar.com/avatar/' . $hash . '?s='.$size.'&d='.$d;
		return $image_url;
	}
}

?>