<?php 

	/**
	 * 
	 */
	class lib_lang
	{
		
		function __construct($lang = null)
		{
			if (!isset($_SESSION['lang'])) {
				$lang = "ar";
			}

			switch ($lang) {
				case "fr":
					$_SESSION['lang'] = "fr";
					break;
				
				case "ar":
					$_SESSION['lang'] = "ar";
					break;
			}
			
		}

	}


 ?>