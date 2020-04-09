<?php 

	/**
	 * 
	 */
	class controller_error
	{
		
		function __construct()
		{

		}

		public function Index()
		{
			// include header
			include BACKEND_URL."includes/header.inc.php";

			// init error view 
			new view_error;

			// include footer
			include BACKEND_URL."includes/footer.inc.php";
		}
	}

 ?>