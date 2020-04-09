<?php 

	/**
	 * 
	 */
	class controller_dc
	{
		
		function __construct()
		{
			if (!isset($_SESSION['user'])) {
				header("Location: ".PUBLIC_URL);
			}
		}

		public function Index()
		{
			$mod = new model_user();

			$mod->logout();

			header("Location: ".PUBLIC_URL);
		}
	}

 ?>