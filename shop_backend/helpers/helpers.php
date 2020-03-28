<?php 

	function shortenText($text, $chars = 100)
	{
	
		if (strlen($text) > $chars+1) // if you want...
		{
		    $text = substr($text, 0, $chars);
		    return $text." ...";
		}else{
			return $text;
		}
	}


	function DeletePic($link)
	{
		if (file_exists($link)) {
			return unlink($link);
		}

		return false;
	}

	function UploadPic($file)
	{
		// image mime to be checked 
			$imagetype = array(image_type_to_mime_type(IMAGETYPE_GIF), image_type_to_mime_type(IMAGETYPE_JPEG),
			    image_type_to_mime_type(IMAGETYPE_PNG), image_type_to_mime_type(IMAGETYPE_BMP));
			
			$FOLDER = "img/";
			$myfile = $file;
			$keepName = false; // change this for file name.
			    if ($myfile["name"] <> "" && $myfile["error"] == 0) {
			        // file is ok
			        if (in_array($myfile["type"], $imagetype)) {
			            //Set file name
			            if($keepName) {
			                $file_name =  $myfile["name"];
			            } else {
			                // get extention and set unique name
			                $file_extention = @strtolower(@end(@explode(".", $myfile["name"])));
			                $file_name = date("Ymd") . '_' . rand(10000, 990000) . '.' . $file_extention;
			            }
			            if (move_uploaded_file($myfile["tmp_name"], $FOLDER . $file_name)) {
			            	return $file_name;
			            } else {
			                return null;
			            }
			        } else {
			            return null;
			        }
			    }
					
	}

	function token($length = 20) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ&:,';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

 ?>